<?php

namespace A17\VitrineUI\Commands;

use Illuminate\Support\Arr;
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
                            {--stories : Publish only the stories for the component}
                            {--force : Overwrite existing files}';

    public $description = 'Publish a component';

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var array
     */
    protected $vitrineUIComponents;

    /**
     * @var array
     */
    protected $assets;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->vitrineUIComponents = config('vitrine-ui.components', []);
        $this->assets = [];
    }

    public function handle(): int
    {
        $all = $this->option('all');
        $components = $this->argument('components');

        if($all){
            $components = array_keys($this->vitrineUIComponents);
        }else{
            if(empty($components)){
                $publishable = array_filter($this->vitrineUIComponents, function($item){
                    return Str::startsWith($item, 'A17\VitrineUI\Components\\');
                });

                if(empty($publishable)){
                    $this->error('No more publishable components. Exiting.');

                    return 1;
                }

                $selectedComponents  = $this->choice(
                    'Which components would you like to publish?',
                    ['all', ...array_keys($publishable)],
                    0,
                    null,
                    true
                );

                $components = in_array('all', $selectedComponents) ? array_keys($this->vitrineUIComponents) : $selectedComponents;
            }else{
                // validate selected components
                foreach ($components as $key => $alias) {
                    // if (! $component = $allComponents[$alias] ?? null) {
                    if(!array_key_exists($alias, $this->vitrineUIComponents)){
                        $this->error("Cannot find the given [$alias] component. Skipping.");

                        unset($components[$key]);
                    }
                }
            }
        }

        // publish selected components to vendor directory
        foreach($components as $value){
            $this->publishComponent($this->vitrineUIComponents[$value]);
        }

        // Get assets array from each component and flag in console
        $this->notifyAssets();

        $this->comment('All done. ');

        return self::SUCCESS;
    }

    protected function publishComponent($component = null)
    {
        if(!$component){
            $this->error('No component defined');

            return 1;
        }


        $class = str_replace(['A17\\VitrineUI\\Components\\', 'App\\View\\Components\\VitrineUI\\'], '', $component);
        $name = str_replace(['_', '.-'], ['-', '/'], Str::snake(str_replace('\\', '.', $class)));

        $this->collectAssets($component);

        if ($this->option('view') || (! $this->option('class') && ! $this->option('stories'))) {
            $this->publishView($component, $name, $class);
        }

        if ($this->option('class') || (! $this->option('view') && ! $this->option('stories'))) {
            $this->publishClass($component, $name, $class);
        }

        if ($this->option('stories') || (! $this->option('view') && ! $this->option('class'))) {
            $this->publishStories($name);
        }

        return 0;
    }

    protected function notifyAssets()
    {
        if(empty($this->assets)){
            return 0;
        }

        $this->info("\n--------\n");

        if(Arr::has($this->assets, 'npm')) {
            $this->info("The published components require the following npm packages:\n");

            $this->info(join("\n", $this->assets['npm']));

            $this->info("\n--------\n");
        }

        if(Arr::has($this->assets, 'behaviors')) {
            $this->info("The published components require the following behaviors (can be found in their component directory):\n");

            $this->info(join("\n", $this->assets['behaviors']));
            $this->info("\n--------\n");
        }

        if(Arr::has($this->assets, 'css')) {
            $this->info("The published components require the following css (can be found in their component directory):\n");

            $this->info(join("\n", $this->assets['css']));

            $this->info("\n--------\n");
        }
    }

    protected function collectAssets($component = null)
        {
        $assets = $component::assets();

        foreach($assets as $type => $asset){
            $asset = is_array($asset) ? $asset : [ $asset ];

            if(Arr::has($this->assets, $type)){
                $this->assets[$type] = array_unique(array_merge($this->assets[$type], $asset));
            }else{
                $this->assets[$type] = $asset;
            }
        }

        return 0;
    }

    protected function publishView($component = false, $name = false, $class = false)
    {
        if(!$component || !$name || !$class){
            $this->error('Missing params');

            return 1;
        }

        $originalView = __DIR__.'/../../resources/views/components/'.$name;
        $publishedView = resource_path('views/vendor/vitrine-ui/components/'.$name);
        $path = Str::beforeLast($publishedView, '/');

        if (! $this->option('force') && $this->filesystem->exists($publishedView)) {
            $this->error("The view at [$publishedView] already exists.");

            return 1;
        }

        $this->filesystem->ensureDirectoryExists($path);

        $this->filesystem->copyDirectory($originalView, $publishedView);

        $this->info("Published view [$publishedView]");
    }

    protected function publishClass($component = false, $name = false, $class = false)
    {
        if(!$component || !$name || !$class){
            $this->error('Missing params');

            return 1;
        }

        $class = ucfirst($class);
        $path = $this->laravel->basePath('app/View/Components/VitrineUI');
        $destination = $path.'/'. str_replace('\\', '/', $class).'.php';

        if (! $this->option('force') && $this->filesystem->exists($destination)) {
            $this->error("The class at [$destination] already exists.");

            return 1;
        }

        $this->filesystem->ensureDirectoryExists(Str::beforeLast($destination, '/'));

        $stub = $this->filesystem->get(__DIR__.'/stubs/Component.stub');
        $namespace = Str::contains($class, '\\') ? '\\'. Str::beforeLast($class, '\\') : '';
        $name = Str::afterLast($class, '\\');
        $alias = 'Original'.$name;

        $stub = str_replace(
            ['{{ namespace }}', '{{ name }}', '{{ parent }}', '{{ alias }}'],
            [$namespace, $name, $component, $alias],
            $stub,
        );

        $this->filesystem->put($destination, $stub);

        $this->info("Published class [$component]");

        // Update config entry of component to new class.
        if ($this->filesystem->missing($config = $this->laravel->configPath('vitrine-ui.php'))) {
            $this->call('vendor:publish', ['--tag' => 'vitrine-ui-config']);
        }

        $originalConfig = $this->filesystem->get($config);

        $modifiedConfig = str_replace($component, 'App\\View\\Components\\VitrineUI\\'.$class, $originalConfig);

        $this->filesystem->put($config, $modifiedConfig);
    }

    protected function publishStories($name = false)
    {
        if(!$name){
            $this->error('Missing params');

            return 1;
        }

        $originalStory = __DIR__.'/../../resources/views/stories/'.$name;
        $publishedStory = resource_path('views/stories/'.$name);
        $path = Str::beforeLast($publishedStory, '/');

        if($this->confirm("Do you want to copy story preset data files?", false)){
            $this->copyStoryData();
        }


        if (! $this->option('force') && $this->filesystem->exists($publishedStory)) {
            $this->error("The story at [$publishedStory] already exists.");

            return 1;
        }

        $this->filesystem->ensureDirectoryExists($path);

        $this->filesystem->copyDirectory($originalStory, $publishedStory);

        $this->info("Published stories [$publishedStory");
    }

    protected function copyStoryData()
    {
        $originalPath = __DIR__.'/../../resources/views/stories/data';
        $publishedPath = resource_path('views/stories/data');
        $files = $this->filesystem->allFiles($originalPath);
        $copyFile = true;

        $this->filesystem->ensureDirectoryExists($publishedPath);

        foreach($files as $file){
            $filepath = $file->getPath();
            $filename = $file->getFilename();

            // ? This copies all the files in the directory so it's not a good idea to use the --force option. Asking each time may not be best either. Who knows?

            if($this->filesystem->exists($filepath)){
                $copyFile = $this->confirm("[$publishedPath/$filename] already exists. Overwrite? This cannot be undone.", false);
            }

            if($copyFile){
                $this->filesystem->copy($filepath . '/'. $filename, $publishedPath . '/'. $filename);

                $this->info("Published story data [$filename]");
            }else{
                $this->error("Skipping story data [$filename]");
            }
        }
    }
}
