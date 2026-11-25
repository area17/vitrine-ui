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
                            {--force : Overwrite existing files}
                            {--list : List the components that can be published, with their class, stories and assets}
                            {--dry-run : List what would be written, without touching any file}';

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

    protected bool $dryRun = false;

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
        $this->dryRun = (bool) $this->option('dry-run');
        $this->assets = ['js' => [], 'css' => [], 'npm' => [], 'optional' => []];

        if ($this->option('list')) {
            return $this->listComponents();
        }

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
            $components = array_keys($this->manifest);
        } else {
            if (empty($components)) {
                // Components with a class already replaced by an app class in the config are not offered again
                $publishable = array_filter(
                    array_keys($this->manifest),
                    fn(string $alias) => $this->manifest[$alias]['class'] === null ||
                        Str::startsWith($this->vitrineUIComponents[$alias] ?? '', self::PACKAGE_NAMESPACE),
                );

                if (empty($publishable)) {
                    $this->error('No more publishable components. Exiting.');

                    return self::FAILURE;
                }

                $selectedComponents = $this->choice(
                    'Which components would you like to publish?',
                    ['all', ...$publishable],
                    0,
                    null,
                    true,
                );

                $components = in_array('all', $selectedComponents) ? array_keys($this->manifest) : $selectedComponents;
            } else {
                // validate selected components
                foreach ($components as $key => $alias) {
                    if (!array_key_exists($alias, $this->manifest)) {
                        $this->failWith("Cannot find the given [$alias] component. Skipping.");

                        unset($components[$key]);
                    }
                }

                if (empty($components)) {
                    return self::FAILURE;
                }
            }
        }

        $withAssets = $this->option('assets') || $this->publishedEverything;

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

        if ($withAssets) {
            $this->notifyAssets();
        }

        $this->comment($this->dryRun ? 'Dry run, no file was written.' : 'All done. ');

        return $this->failed ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Report a write, or what would be written with --dry-run
     */
    protected function report(string $action, string $what): void
    {
        $this->info($this->dryRun ? "[dry-run] Would $action $what" : ucfirst(rtrim($action, 'e')) . "ed $what");
    }

    /**
     * Report an error and make the command exit with a failure code
     */
    protected function listComponents(): int
    {
        $rows = [];

        foreach ($this->manifest as $alias => $entry) {
            $assets = array_merge($entry['assets']['js'] ?? [], $entry['assets']['css'] ?? []);

            $rows[] = [
                $alias,
                $entry['class'] === null ? 'blade' : 'class',
                $entry['stories'] === null ? '-' : 'yes',
                $assets ? implode(', ', array_map('basename', $assets)) : '-',
            ];
        }

        $this->table(['Component', 'Type', 'Stories', 'Assets'], $rows);

        return self::SUCCESS;
    }

    protected function failWith(string $message): void
    {
        $this->error($message);

        $this->failed = true;
    }

    protected function publishComponent(string $alias): void
    {
        $component = $this->manifest[$alias]['class'];

        if ($this->option('view') || $this->publishedEverything) {
            $this->newLine();
            $this->publishView($alias);
        }

        if ($this->option('class') || $this->publishedEverything) {
            $this->newLine();

            if ($component !== null) {
                $this->publishClass($component, Str::after($component, self::PACKAGE_NAMESPACE));
            } elseif ($this->option('class')) {
                $this->warn("[$alias] is a Blade component, it has no class to publish.");
            }
        }

        if ($this->option('stories') || $this->publishedEverything) {
            $this->newLine();
            $this->publishStories($alias, empty($this->argument('components')));
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
            $this->info("\nOptional, only for [$feature], not copied. Copy them from the package if you use it:");
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
     * Copy the JS files of the published components (and the files they import) into the app,
     * then generate vitrine-ui.js, exporting their behaviors.
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

            $lines[] = "export { default as $name } from './" . self::BEHAVIORS . "/$file'";
        }

        $folder = (string) config('vitrine-ui.js_path');

        $this->copyAssetFiles('js', $this->withLocalImports($this->assets['js']), $folder);

        $this->writeImportFile(
            $folder . '/' . self::JS_FILE,
            $lines,
            'export {',
            '// Generated by `vitrine-ui:publish`, running it again adds the behaviors of the components you publish.',
        );

        $relative = Str::after($folder . '/' . self::JS_FILE, base_path() . '/');

        $this->info(
            "Import it in your app's js and register it: import * as VitrineBehaviors from '$relative', then manageBehaviors.init(VitrineBehaviors)",
        );
    }

    /**
     * Copy the CSS files of the published components into the app, then generate vitrine-ui.css importing them.
     */
    protected function writeCssImports(): void
    {
        $folder = (string) config('vitrine-ui.css_path');

        $this->copyAssetFiles('css', $this->assets['css'], $folder);

        $this->writeImportFile(
            $folder . '/' . self::CSS_FILE,
            array_map(fn(string $css) => "@import \"./$css\";", $this->assets['css']),
            '@import',
            '/* Generated by `vitrine-ui:publish`, running it again adds the css of the components you publish. */',
        );
    }

    /**
     * Copy asset files, keeping their path inside the package's frontend folder. Existing files are kept unless --force is used.
     *
     * @param array<int, string> $files paths relative to the package's js or css folder
     */
    protected function copyAssetFiles(string $type, array $files, string $folder): void
    {
        foreach ($files as $file) {
            $destination = $folder . '/' . $file;

            if (isset($this->handled[$destination])) {
                continue;
            }

            $this->handled[$destination] = true;

            if (!$this->option('force') && $this->filesystem->exists($destination)) {
                $this->warn("The file at [$destination] already exists. Use --force to overwrite it.");

                continue;
            }

            if (!$this->dryRun) {
                $this->filesystem->ensureDirectoryExists(dirname($destination));
                $this->filesystem->copy(
                    VitrineUI::resourcesPath(self::ASSET_FOLDERS[$type] . '/' . $file),
                    $destination,
                );
            }

            $this->report('publish', "file [$destination]");
        }
    }

    /**
     * Add the files imported with a relative path ('../utils/formatDate', './DateInput'), recursively.
     *
     * @param array<int, string> $files paths relative to the package's js folder
     * @return array<int, string>
     */
    protected function withLocalImports(array $files): array
    {
        $all = [];

        while ($file = array_shift($files)) {
            if (isset($all[$file])) {
                continue;
            }

            $all[$file] = true;
            $source = VitrineUI::resourcesPath(self::ASSET_FOLDERS['js'] . '/' . $file);

            if (!$this->filesystem->exists($source)) {
                continue;
            }

            preg_match_all('/from \'(\.{1,2}\/[^\']+)\'/', $this->filesystem->get($source), $matches);

            foreach ($matches[1] as $import) {
                // Collapse `behaviors/../utils/x` into `utils/x`
                $parts = [];
                foreach (explode('/', dirname($file) . '/' . $import) as $part) {
                    if ($part === '..') {
                        array_pop($parts);
                    } elseif ($part !== '.' && $part !== '') {
                        $parts[] = $part;
                    }
                }

                $files[] = implode('/', $parts) . (str_ends_with($import, '.js') ? '' : '.js');
            }
        }

        return array_keys($all);
    }

    /**
     * Merge new import lines into a generated file, keeping the ones of components published earlier.
     *
     * @param array<int, string> $lines
     */
    protected function writeImportFile(string $target, array $lines, string $linePrefix, string $header): void
    {
        if (!$lines) {
            return;
        }

        $existing = $this->filesystem->exists($target)
            ? array_filter(
                explode("\n", $this->filesystem->get($target)),
                fn($line) => str_starts_with($line, $linePrefix),
            )
            : [];

        // Key lines by what they export/import, not by formatting (a formatter may have added a semicolon or changed
        // the quotes). Existing lines win, so their import targets are kept, except lines pointing to the vendor folder
        // (previous version of the command): those are replaced by the local copy when the component is published,
        // and kept otherwise so unrelated components keep working.
        $keyOf = function (string $line): string {
            $line = trim($line);

            if (!preg_match('/^export \{ default as (\w+) \}|^@import\s+["\']([^"\']+)/', $line, $m)) {
                return $line;
            }

            // A vendor css import has the same key as its local copy
            $key = end($m);
            $vendorCss = VitrineUI::vendorResourcesPath(self::ASSET_FOLDERS['css']) . '/';

            return str_contains($key, $vendorCss) ? './' . Str::after($key, $vendorCss) : $key;
        };

        $byKey = [];
        foreach ($existing as $line) {
            $byKey[$keyOf($line)] ??= $line;
        }
        foreach ($lines as $line) {
            $key = $keyOf($line);

            if (!isset($byKey[$key]) || str_contains($byKey[$key], 'vendor/area17/')) {
                $byKey[$key] = $line;
            }
        }

        $all = array_values($byKey);
        sort($all);

        if (!$this->dryRun) {
            $this->filesystem->ensureDirectoryExists(dirname($target));
            $this->filesystem->put($target, $header . "\n\n" . implode("\n", $all) . "\n");
        }

        $this->report('update', "[$target]");

        if ($this->dryRun) {
            foreach (array_diff($all, $existing) as $line) {
                $this->line("    + $line");
            }
        }
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
        foreach ($this->withDependencies($alias) as $name) {
            $assets = $this->manifest[$name]['assets'];

            foreach (['js', 'css', 'npm'] as $type) {
                $this->assets[$type] = array_values(
                    array_unique(array_merge($this->assets[$type], (array) ($assets[$type] ?? []))),
                );
            }

            foreach ($assets['optional'] ?? [] as $feature => $group) {
                $this->assets['optional']["$name: $feature"] = $group;
            }
        }
    }

    /**
     * The alias and, transitively, the components its view renders with <x-vui-*>.
     * A view folder shared by several aliases (media, tabs) counts as a whole.
     *
     * @param array<string, true> $seen
     * @return array<int, string>
     */
    protected function withDependencies(string $alias, array &$seen = []): array
    {
        if (isset($seen[$alias])) {
            return [];
        }

        $seen[$alias] = true;
        $folder = VitrineUI::resourcesPath(self::COMPONENT_VIEWS . '/' . $this->manifest[$alias]['view']);
        $files = $this->filesystem->isDirectory($folder) ? $this->filesystem->allFiles($folder) : [];

        foreach ($files as $file) {
            preg_match_all('/<x-vui-([a-z0-9-]+)/', $this->filesystem->get($file->getPathname()), $matches);

            foreach ($matches[1] as $child) {
                if (isset($this->manifest[$child])) {
                    $this->withDependencies($child, $seen);
                }
            }
        }

        return array_keys($seen);
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

        if (!$this->dryRun) {
            $this->filesystem->ensureDirectoryExists(Str::beforeLast($destination, '/'));
            $this->filesystem->copyDirectory($source, $destination);
        }

        $this->report('publish', "$label [$destination]");
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

        $stub = $this->filesystem->get(__DIR__ . '/stubs/Component.stub');
        $namespace = Str::contains($class, '\\') ? '\\' . Str::beforeLast($class, '\\') : '';
        $name = Str::afterLast($class, '\\');

        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}', '{{ parent }}', '{{ alias }}'],
            [$namespace, $name, $component, 'Original' . $name],
            $stub,
        );

        if (!$this->dryRun) {
            $this->filesystem->ensureDirectoryExists(Str::beforeLast($destination, '/'));
            $this->filesystem->put($destination, $stub);
        }

        $this->report('publish', "class [$destination]");

        // Update config entry of component to new class.
        $config = $this->laravel->configPath('vitrine-ui.php');

        if ($this->filesystem->missing($config)) {
            if ($this->dryRun) {
                $this->report('publish', "config [$config]");
            } else {
                $this->call('vendor:publish', ['--tag' => 'vitrine-ui-config']);
            }
        }

        // Match the `::class` suffix, otherwise `Card` would also rewrite `CardLink`
        $search = $component . '::class';
        $replace = self::APP_NAMESPACE . $class . '::class';

        if (!$this->dryRun) {
            $this->filesystem->put($config, str_replace($search, $replace, $this->filesystem->get($config)));
        }

        $this->report('update', "[$config]: $search => $replace");
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

        foreach ($this->filesystem->allFiles($originalPath) as $file) {
            $filename = $file->getFilename();

            // Files are shared by all the stories, existing ones are skipped unless --force is used
            if (!$this->option('force') && $this->filesystem->exists("$publishedPath/$filename")) {
                $this->warn("Skipping story data [$filename], it already exists. Use --force to overwrite it.");

                continue;
            }

            if (!$this->dryRun) {
                $this->filesystem->ensureDirectoryExists($publishedPath);
                $this->filesystem->copy($file->getPathname(), "$publishedPath/$filename");
            }

            $this->report('publish', "story data [$publishedPath/$filename]");
        }
    }
}
