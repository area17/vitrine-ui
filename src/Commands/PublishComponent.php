<?php
namespace A17\VitrineUI\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishComponent extends Command
{
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
        $this->manifest = require __DIR__ . '/../../resources/manifest.php';
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
                    return Str::startsWith($item, 'A17\VitrineUI\Components\\');
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
        $class = Str::after($component, 'A17\\VitrineUI\\Components\\');

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

        $base = 'vendor/area17/vitrine-ui/resources/frontend';

        $this->info("\n--------\n");
        $this->info('The published components need the following assets in your app');

        if ($this->assets['js']) {
            $this->info("\nJS behaviors (import and register them with @area17/a17-behaviors):");
            foreach ($this->assets['js'] as $js) {
                $this->line("  $base/scripts/$js");
            }
        }

        if ($this->assets['css']) {
            $this->info("\nCSS (@import them in your main css file, path relative to it):");
            foreach ($this->assets['css'] as $css) {
                $this->line("  $base/css/$css");
            }
        }

        if ($this->assets['npm']) {
            $this->info("\nnpm packages:\n  npm i " . join(' ', $this->assets['npm']));
        }

        foreach ($this->assets['optional'] as $feature => $group) {
            $this->info("\nOptional, only for [$feature]:");
            foreach ($group['js'] ?? [] as $js) {
                $this->line("  $base/scripts/$js");
            }
            foreach ($group['css'] ?? [] as $css) {
                $this->line("  $base/css/$css");
            }
            if (!empty($group['npm'])) {
                $this->line('  npm i ' . join(' ', $group['npm']));
            }
        }

        $this->info("\n--------\n");
    }

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
            __DIR__ . '/../../resources/views/components/' . $folder,
            resource_path('views/vendor/vitrine-ui/components/' . $folder),
        );
    }

    protected function publishClass(string $component, string $class): void
    {
        $class = ucfirst($class);
        $path = $this->laravel->basePath('app/View/Components/VitrineUI');
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
            'App\\View\\Components\\VitrineUI\\' . $class . '::class',
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
            __DIR__ . '/../../resources/views/stories/' . $folder,
            resource_path('views/stories/' . $destination),
            $quiet,
        );
    }

    protected function copyStoryData(): void
    {
        $originalPath = __DIR__ . '/../../resources/views/stories/data';
        $publishedPath = resource_path('views/stories/data');

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
