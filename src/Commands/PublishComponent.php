<?php
namespace A17\VitrineUI\Commands;

use Illuminate\Support\Str;
use A17\VitrineUI\VitrineUI;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishComponent extends Command
{
    /**
     * Asset type => folder in the package's resources (the manifest paths are relative to these)
     */
    public const ASSET_FOLDERS = ['js' => 'frontend/scripts', 'css' => 'frontend/css'];

    /** Folder of the behaviors, in the js folder */
    protected const BEHAVIORS = 'behaviors';

    /** Views and stories folders, in the package's resources and in the app's resources */
    protected const COMPONENT_VIEWS = 'views/components';
    protected const STORIES = 'views/stories';

    protected const PACKAGE_NAMESPACE = 'A17\\VitrineUI\\Components\\';
    protected const APP_NAMESPACE = 'App\\View\\Components\\VitrineUI\\';
    protected const APP_CLASSES_PATH = 'app/View/Components/VitrineUI';

    protected const JS_FILE = 'vitrine-ui.js';
    protected const CSS_FILE = 'vitrine-ui.css';

    public $signature = 'vitrine-ui:publish
                            {components?* : The component names to export. If left blank it will prompt which components to publish}
                            {--all : publish all vitrine-ui components to project}
                            {--view : Publish only the view of the component}
                            {--class : Publish only the class of the component}
                            {--assets : Publish only the assets of the component}
                            {--stories : Publish only the stories for the component}
                            {--force : Overwrite existing files}';

    public $description = 'Publish a component';

    protected Filesystem $filesystem;

    /** @var array<string, string> */
    protected array $vitrineUIComponents;

    /** @var array<string, array{class: ?string, view: string, stories: ?string, assets: array}> */
    protected array $manifest;

    protected array $assets = ['js' => [], 'css' => [], 'npm' => [], 'optional' => []];

    protected bool $publishedEverything;

    protected string $storiesSubfolder;

    /** Destinations already handled during this run, so shared folders are published once */
    protected array $handled = [];

    protected bool $failed = false;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->manifest = require VitrineUI::resourcesPath('manifest.php');
        $this->vitrineUIComponents = config('vitrine-ui.components', []);
        $this->storiesSubfolder = trim((string) config('vitrine-ui.stories_subfolder', ''), '/');
        $this->publishedEverything = true;
    }

    public function handle(): int
    {
        // The command instance can be reused (tests, programmatic calls), start every run clean
        $this->handled = [];
        $this->failed = false;
        $this->assets = ['js' => [], 'css' => [], 'npm' => [], 'optional' => []];

        $all = $this->option('all');
        $components = $this->argument('components');

        // Detect if unique options are used otherwise publish everything
        $this->publishedEverything =
            count(
                array_filter(
                    array_filter(
                        $this->options(),
                        fn($item) => in_array($item, ['view', 'stories', 'assets', 'class']),
                        ARRAY_FILTER_USE_KEY,
                    ),
                ),
            ) === 0;

        if ($all) {
            $components = array_keys($this->vitrineUIComponents);
        } else {
            if (empty($components)) {
                $publishable = array_filter($this->vitrineUIComponents, function ($item) {
                    return Str::startsWith($item, self::PACKAGE_NAMESPACE);
                });

                if (empty($publishable)) {
                    $this->error('No more publishable components. Exiting.');

                    return self::FAILURE;
                }

                $selectedComponents = $this->choice(
                    'Which components would you like to publish?',
                    ['all', ...array_keys($publishable)],
                    0,
                    null,
                    true,
                );

                $components = in_array('all', $selectedComponents)
                    ? array_keys($this->vitrineUIComponents)
                    : $selectedComponents;
            } else {
                // validate selected components
                foreach ($components as $key => $alias) {
                    if (
                        !array_key_exists($alias, $this->vitrineUIComponents) ||
                        !isset($this->manifest[$alias]['class'])
                    ) {
                        $this->fail("Cannot find the given [$alias] component. Skipping.");

                        unset($components[$key]);
                    }
                }

                if (empty($components)) {
                    return self::FAILURE;
                }
            }
        }

        $withAssets = $this->option('assets') || $this->publishedEverything;
        $withBladeComponents = empty($this->argument('components'));

        // Copy story preset data
        if ($this->option('stories') || $this->publishedEverything) {
            $this->copyStoryData();
        }

        // publish selected components to vendor directory
        foreach ($components as $alias) {
            $this->publishComponent($alias);

            if ($withAssets) {
                $this->collectAssets($alias);
            }
        }

        // Blade-only components (no class) are included when no component is named
        if ($withBladeComponents) {
            $bladeComponents = array_keys(array_filter($this->manifest, fn($entry) => $entry['class'] === null));

            if ($withAssets) {
                foreach ($bladeComponents as $alias) {
                    $this->collectAssets($alias);
                }
            }

            if ($this->option('stories') || $this->publishedEverything) {
                $this->comment('Publishing stories for blade components without class ');

                foreach ($bladeComponents as $alias) {
                    $this->publishStories($alias, true);
                }
            }
        }

        if ($withAssets) {
            $this->notifyAssets();
        }

        $this->comment('All done. ');

        return $this->failed ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Report an error and make the command exit with a failure code
     */
    protected function fail(string $message): void
    {
        $this->error($message);

        $this->failed = true;
    }

    protected function publishComponent(string $alias): void
    {
        $component = $this->manifest[$alias]['class'];
        $class = Str::after($component, self::PACKAGE_NAMESPACE);

        if ($this->option('view') || $this->publishedEverything) {
            $this->newLine();
            $this->publishView($alias);
        }

        if ($this->option('class') || $this->publishedEverything) {
            $this->newLine();
            $this->publishClass($component, $class);
        }

        if ($this->option('stories') || $this->publishedEverything) {
            $this->newLine();
            $this->publishStories($alias);
        }
    }

    protected function notifyAssets(): void
    {
        if (!array_filter($this->assets)) {
            return;
        }

        $this->info("\n--------\n");

        $this->writeJsImports();
        $this->writeCssImports();

        if ($this->assets['npm']) {
            $this->info(
                "\nThe published components need these npm packages:\n  npm i " . join(' ', $this->assets['npm']),
            );
        }

        foreach ($this->assets['optional'] as $feature => $group) {
            $this->info("\nOptional, only for [$feature], import them yourself if you use it:");
            foreach ($group['js'] ?? [] as $js) {
                $this->line('  ' . VitrineUI::vendorResourcesPath(self::ASSET_FOLDERS['js'] . "/$js"));
            }
            foreach ($group['css'] ?? [] as $css) {
                $this->line('  ' . VitrineUI::vendorResourcesPath(self::ASSET_FOLDERS['css'] . "/$css"));
            }
            if (!empty($group['npm'])) {
                $this->line('  npm i ' . join(' ', $group['npm']));
            }
        }

        $this->info("\n--------\n");
    }

    /**
     * Generate vitrine-ui.js, exporting the behaviors of the published components from the vendor folder.
     */
    protected function writeJsImports(): void
    {
        $names = $this->behaviorNames();
        $lines = [];

        foreach ($this->assets['js'] as $js) {
            // Only behaviors are registered, the other files (utils) are imported by the behaviors themselves
            if (!Str::startsWith($js, self::BEHAVIORS . '/')) {
                continue;
            }

            $file = Str::after(Str::beforeLast($js, '.js'), self::BEHAVIORS . '/');
            $name = $names[$file] ?? Str::studly($file);

            $lines[] = fn(string $base) => "export { default as $name } from '{$base}" . self::BEHAVIORS . "/$file'";
        }

        $target = config('vitrine-ui.js_path') . '/' . self::JS_FILE;

        $this->writeImportFile(
            'js',
            $target,
            $lines,
            'export {',
            '// Generated by `vitrine-ui:publish`, running it again adds the behaviors of the components you publish.',
        );

        $relative = Str::after($target, base_path() . '/');

        $this->info(
            "Import it in your app's js and register it: import * as VitrineBehaviors from '$relative', then manageBehaviors.init(VitrineBehaviors)",
        );
    }

    /**
     * Generate vitrine-ui.css, importing the css files of the published components from the vendor folder.
     */
    protected function writeCssImports(): void
    {
        $lines = array_map(fn(string $css) => fn(string $base) => "@import \"{$base}$css\";", $this->assets['css']);

        $target = config('vitrine-ui.css_path') . '/' . self::CSS_FILE;

        $this->writeImportFile(
            'css',
            $target,
            $lines,
            '@import',
            '/* Generated by `vitrine-ui:publish`, running it again adds the css of the components you publish. */',
        );
    }

    /**
     * Merge new import lines into a generated file, keeping the ones of components published earlier.
     *
     * @param array<int, callable(string): string> $lines closures building a line from the relative path to the package's frontend folder
     */
    protected function writeImportFile(
        string $type,
        string $target,
        array $lines,
        string $linePrefix,
        string $header,
    ): void {
        if (!$lines) {
            return;
        }

        $base = $this->relativePath(
            dirname($target),
            base_path(VitrineUI::vendorResourcesPath(self::ASSET_FOLDERS[$type])),
        );

        $existing = $this->filesystem->exists($target)
            ? array_filter(
                explode("\n", $this->filesystem->get($target)),
                fn($line) => str_starts_with($line, $linePrefix),
            )
            : [];

        $all = array_unique([...$existing, ...array_map(fn($line) => $line($base), $lines)]);
        sort($all);

        $this->filesystem->ensureDirectoryExists(dirname($target));
        $this->filesystem->put($target, $header . "\n\n" . implode("\n", $all) . "\n");

        $this->info("Updated [$target]");
    }

    /**
     * Relative path from a folder to another one, with a trailing slash. Both are absolute.
     */
    protected function relativePath(string $from, string $to): string
    {
        $from = explode('/', trim($from, '/'));
        $to = explode('/', trim($to, '/'));

        while ($from && $to && $from[0] === $to[0]) {
            array_shift($from);
            array_shift($to);
        }

        return str_repeat('../', count($from)) . ($to ? implode('/', $to) . '/' : '');
    }

    /**
     * Behavior names (what `data-behavior` uses) by file name, read from the behaviors barrel file.
     *
     * @return array<string, string>
     */
    protected function behaviorNames(): array
    {
        $barrel = $this->filesystem->get(
            VitrineUI::resourcesPath(self::ASSET_FOLDERS['js'] . '/' . self::BEHAVIORS . '/index.js'),
        );

        preg_match_all("/export \{ default as (\w+) \} from '\.\/(\w+)'/", $barrel, $matches);

        return array_combine($matches[2], $matches[1]);
    }

    /**
     * Collect the assets of a component alias from the manifest
     */
    protected function collectAssets(string $alias): void
    {
        $assets = $this->manifest[$alias]['assets'];

        foreach (['js', 'css', 'npm'] as $type) {
            $this->assets[$type] = array_values(
                array_unique(array_merge($this->assets[$type], (array) ($assets[$type] ?? []))),
            );
        }

        foreach ($assets['optional'] ?? [] as $feature => $group) {
            $this->assets['optional']["$alias: $feature"] = $group;
        }
    }

    /**
     * Copy a folder of the package to the app, once per run. Existing destinations are kept unless --force is used.
     */
    protected function copyFolder(string $label, string $source, string $destination, bool $quiet = false): void
    {
        if (isset($this->handled[$destination])) {
            return;
        }

        $this->handled[$destination] = true;

        if (!$this->filesystem->isDirectory($source)) {
            if (!$quiet) {
                $this->warn("No $label to publish for this component.");
            }

            return;
        }

        if (!$this->option('force') && $this->filesystem->exists($destination)) {
            $this->warn("The $label at [$destination] already exists. Use --force to overwrite it.");

            return;
        }

        $this->filesystem->ensureDirectoryExists(Str::beforeLast($destination, '/'));
        $this->filesystem->copyDirectory($source, $destination);

        $this->info("Published $label [$destination]");
    }

    protected function publishView(string $alias): void
    {
        $folder = $this->manifest[$alias]['view'];

        $this->copyFolder(
            'view',
            VitrineUI::resourcesPath(self::COMPONENT_VIEWS . '/' . $folder),
            resource_path('views/vendor/vitrine-ui/components/' . $folder),
        );
    }

    protected function publishClass(string $component, string $class): void
    {
        $class = ucfirst($class);
        $path = $this->laravel->basePath(self::APP_CLASSES_PATH);
        $destination = $path . '/' . str_replace('\\', '/', $class) . '.php';

        if (!$this->option('force') && $this->filesystem->exists($destination)) {
            $this->warn("The class at [$destination] already exists. Use --force to overwrite it.");

            return;
        }

        $this->filesystem->ensureDirectoryExists(Str::beforeLast($destination, '/'));

        $stub = $this->filesystem->get(__DIR__ . '/stubs/Component.stub');
        $namespace = Str::contains($class, '\\') ? '\\' . Str::beforeLast($class, '\\') : '';
        $name = Str::afterLast($class, '\\');
        $alias = 'Original' . $name;

        $parent = $component;

        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}', '{{ parent }}', '{{ alias }}'],
            [$namespace, $name, $parent, $alias],
            $stub,
        );

        $this->filesystem->put($destination, $stub);

        $this->info("Published class [$component]");

        // Update config entry of component to new class.
        if ($this->filesystem->missing($config = $this->laravel->configPath('vitrine-ui.php'))) {
            $this->call('vendor:publish', ['--tag' => 'vitrine-ui-config']);
        }

        $originalConfig = $this->filesystem->get($config);

        // Match the `::class` suffix, otherwise `Card` would also rewrite `CardLink`
        $modifiedConfig = str_replace(
            $component . '::class',
            self::APP_NAMESPACE . $class . '::class',
            $originalConfig,
        );

        $this->filesystem->put($config, $modifiedConfig);
    }

    protected function publishStories(string $alias, bool $quiet = false): void
    {
        $folder = $this->manifest[$alias]['stories'];

        if ($folder === null) {
            if (!$quiet) {
                $this->warn('No stories to publish for this component.');
            }

            return;
        }

        $destination = $this->storiesSubfolder === '' ? $folder : $this->storiesSubfolder . '/' . $folder;

        $this->copyFolder(
            'stories',
            VitrineUI::resourcesPath(self::STORIES . '/' . $folder),
            resource_path(self::STORIES . '/' . $destination),
            $quiet,
        );
    }

    protected function copyStoryData(): void
    {
        $originalPath = VitrineUI::resourcesPath(self::STORIES . '/data');
        $publishedPath = resource_path(self::STORIES . '/data');

        $this->filesystem->ensureDirectoryExists($publishedPath);

        foreach ($this->filesystem->allFiles($originalPath) as $file) {
            $filename = $file->getFilename();

            // Files are shared by all the stories, existing ones are skipped unless --force is used
            if (!$this->option('force') && $this->filesystem->exists("$publishedPath/$filename")) {
                $this->warn("Skipping story data [$filename], it already exists. Use --force to overwrite it.");

                continue;
            }

            $this->filesystem->copy($file->getPathname(), "$publishedPath/$filename");

            $this->info("Published story data [$filename]");
        }
    }
}
