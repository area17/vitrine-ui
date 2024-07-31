<?php

namespace A17\VitrineUI\Commands;

use A17\VitrineUI\VitrineUI;
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
                            {--assets : Publish only the assets of the component}
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
    protected $npmPackages;

    /**
     * @var bool
     */
    protected $canCopyStoryData;

    /**
     * @var string
     */
    protected $vendorAssetsPath;

    /**
     * @var string
     */
    protected $publishedAssetsPath;

    /**
     * @var bool
     */
    protected $publishedEverything;

    /**
     * @var string
     */
    protected $storiesSubfolder;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->vitrineUIComponents = config('vitrine-ui.components', []);
        $this->storiesSubfolder = config('vitrine-ui.stories_subfolder', 'null');
        $this->npmPackages = [];
        $this->canCopyStoryData = null;
        $this->vendorAssetsPath = VitrineUI::removeTrailingSlash(config('vitrine-ui.vendor_assets_path', ''));
        $this->publishedAssetsPath = VitrineUI::removeTrailingSlash(config('vitrine-ui.published_assets_path', ''));
        $this->publishedEverything = true;
    }

    public function handle(): int
    {
        $all = $this->option('all');
        $components = $this->argument('components');

        // Detect if unique options are used otherwise publish everything
        $this->publishedEverything = count(array_filter(array_filter($this->options(), fn ($item) => in_array($item, ['view', 'stories', 'assets', 'class']), ARRAY_FILTER_USE_KEY))) === 0;

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

        // Copy story preset data
        if ($this->option('stories') || (! $this->option('view') && ! $this->option('class'))) {
            // if($this->confirm("Do you want to copy story preset data files?", false)) {
                $this->copyStoryData();
            // }
        }

        // publish selected components to vendor directory
        foreach($components as $value){
            $this->publishComponent($this->vitrineUIComponents[$value]);
        }

        // Get assets array from each component and flag in console
        if (
            (!$this->option('stories') && !$this->option('view') && !$this->option('class')) ||
            $this->option('view') || $this->option('class')
        ) {
            $this->notifyNpmPackages();
        }

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


        if ($this->option('assets') || $this->publishedEverything) {
            $this->newLine();
            $this->updateAssets($component, $name);
        }


        if ($this->option('view') || $this->publishedEverything) {
            $this->newLine();
            $this->publishView($component, $name, $class);
        }

        if ($this->option('class') || $this->publishedEverything) {
            $this->newLine();
            $this->publishClass($component, $name, $class);
        }

        if ($this->option('stories') || $this->publishedEverything) {
            $this->newLine();
            $this->publishStories($name);
        }

        return 0;
    }

    protected function notifyNpmPackages()
    {
        if(empty($this->npmPackages)){
            return 0;
        }

        $this->info("\n--------\n");

        $this->info("The published components require the following npm packages");

        $this->newLine();

        $this->info(join("\n", $this->npmPackages));

        $this->info("\nnpm i ". join(' ', $this->npmPackages));

        $this->info("\n--------\n");
    }

    protected function collectAssets($component = null)
    {
        // revert to original class to get assets
        $class = str_replace('App\\View\\Components\\VitrineUI\\', 'A17\\VitrineUI\\Components\\', $component);
        $assets = $class::assets();

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

    protected function updateAssets($component = null, $name = null)
    {
        if(!$component || !$name){
            $this->error('Missing params');

            return 1;
        }

        // revert to original class to get assets
        $class = str_replace('App\\View\\Components\\VitrineUI\\', 'A17\\VitrineUI\\Components\\', $component);
        $assets = $class::assets();

        // CSS
        if(Arr::has($assets, 'css')) {
            $this->handleCssAssets($component, $name, $assets['css']);
        }

        // JS
        if(Arr::has($assets, 'js')) {
            $this->handleJsAssets($component, $name, $assets['js']);
        }

        // NPM
        if(Arr::has($assets, 'npm')) {
            $this->npmPackages = array_merge($this->npmPackages, $assets['npm']);
        }
    }

    protected function handleJsAssets($component = null, $name = null, $assets = null)
    {
        if(!$component || !$name || !$assets){
            $this->error('Missing params');

            return 1;
        }

        $jsPublishPath = config('vitrine-ui.js_path');
        $originalAssetPath = __DIR__ .'/../../resources/frontend';
        $originalJs = "$originalAssetPath/vitrine-ui.js";
        $publishedJs = "$jsPublishPath/vitrine-ui/vitrine-ui.js";

        $jsAssets = is_array($assets) ? $assets : [ $assets ];

        // if vitrine-ui.js does not exist copy vitrine-ui.js to resources/frontend/scripts/vendor/vitrine-ui.js
        if(!$this->filesystem->exists($publishedJs)){
            $this->filesystem->ensureDirectoryExists($jsPublishPath.'/vitrine-ui');
            $this->filesystem->copy($originalJs, $publishedJs);
            $this->info("Published [vitrine-ui.js]. Add [import * as VitrineBehaviors from 'vendor/vitrine-ui'] to your app's js file.");
        }

        // find import for component css and update path to project path
        $publishedJsContent = $this->filesystem->get($publishedJs);

        $oldPath = "'./scripts";
        $newPath = "'$this->vendorAssetsPath/scripts";
        $modifiedJsContent = Str::replace($oldPath, $newPath, $publishedJsContent);

        // replace './js/[behaviors/Input]' with './vendor/vitrine-ui/[behaviors/Input]
        foreach($jsAssets as $asset){
            // get new path (full path before filename)
            $originalAsset = $originalAssetPath .'/scripts/'. $asset;
            $publishedAsset = $jsPublishPath .'/vitrine-ui/'. $asset;

            // ensure it exists
            if(!$this->filesystem->exists($publishedAsset)){
                $this->filesystem->ensureDirectoryExists(Str::beforeLast($publishedAsset, '/'));

                // copy asset to new path
                $this->filesystem->copy($originalAsset, $publishedAsset);
            }

            // update vitrine-ui.js
            $oldAssetPath = $newPath .'/'. $asset;
            $oldAssetPathArr = [$oldAssetPath, Str::beforeLast($oldAssetPath, '.js')];
            $assetNoExtension = Str::beforeLast($asset, '.js');
            $newFilepath = "'./vitrine-ui/". $assetNoExtension;

            if(!Str::contains($modifiedJsContent, $assetNoExtension)){
                $this->info("Can't find $asset in your vitrine-ui.js. Adding it now.");

                $behaviorName = Str::of($asset)->afterLast('/')->beforeLast('.js')->replace('/', '-')->studly();
                $modifiedJsContent .= "export { default as $behaviorName } from '$newFilepath'\n";
            }else{
                $modifiedJsContent = Str::replace($oldAssetPathArr, $newFilepath, $modifiedJsContent);
            }
        }

        $this->filesystem->put($publishedJs, $modifiedJsContent);

        $this->info("Updated path for [$name] in [$jsPublishPath/vitrine-ui.js]");

        return 0;
    }

    protected function handleCssAssets($component = null, $name = null, $assets = null)
    {
        if(!$component || !$name || !$assets){
            $this->error('Missing params');

            return 1;
        }

        $cssPublishPath = config('vitrine-ui.css_path');
        $originalAssetPath = __DIR__ .'/../../resources/frontend';
        $originalCss = "$originalAssetPath/vitrine-ui.css";
        $publishedCss = "$cssPublishPath/vitrine-ui/vitrine-ui.css";

        $cssAssets = is_array($assets) ? $assets : [ $assets ];

        // if vitrine-ui.css does not exist copy vitrine-ui.css to resources/frontend/styles/vendor/vitrine-ui/vitrine-ui.css
        if(!$this->filesystem->exists($publishedCss)){
            $this->filesystem->ensureDirectoryExists($cssPublishPath.'/vitrine-ui');
            $this->filesystem->copy($originalCss, $publishedCss);
            $this->info("Published [vitrine-ui.css]. Add [@import \"vendor/vitrine-ui.css\"] to your app's css file.");
        }

        // find import for component css and update path to project path
        $publishedCssContent = $this->filesystem->get($publishedCss);

        $oldPath = "'./css";
        $newPath = "'$this->vendorAssetsPath/css";
        $modifiedCssContent = Str::replace($oldPath, $newPath, $publishedCssContent);

        // replace './css/[components/input.css] with './vendor/vitrine-ui/[components/input.css]
        foreach($cssAssets as $asset){
            // get new path (full path before filename)
            $originalAsset = $originalAssetPath .'/css/'. $asset;
            $publishedAsset = $cssPublishPath .'/vitrine-ui/'. $asset;

            // ensure it exists
            if(!$this->filesystem->exists($publishedAsset)){
                $this->filesystem->ensureDirectoryExists(Str::beforeLast($publishedAsset, '/'));

                // copy asset to new path
                $this->filesystem->copy($originalAsset, $publishedAsset);
            }

            $oldAssetPath = "$newPath/$asset";
            $newAssetPath = "'./vitrine-ui/$asset";

            if(!Str::contains($modifiedCssContent, $oldAssetPath)){
                $this->info("Can't find $asset in your vitrine-ui.css. Adding it now.");

                $modifiedCssContent .= "@import $newAssetPath';\n";
            }else{
                $modifiedCssContent = Str::replace($oldAssetPath, $newAssetPath, $modifiedCssContent);
            }
        }

        $this->filesystem->put($publishedCss, $modifiedCssContent);

        $this->info("Updated path for [$name] in [$cssPublishPath/vitrine-ui.css]");

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

        $parent = str_replace('App\\View\\Components\\VitrineUI\\', 'A17\\VitrineUI\\Components\\', $component);

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
        $destination = empty($this->storiesSubfolder) ? $name : $this->storiesSubfolder.'/'.$name;
        $publishedStory = resource_path('views/stories/'.$destination);
        $path = Str::beforeLast($publishedStory, '/');

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

            if($this->filesystem->exists("$publishedPath/$filename")){
                $copyFile = false;
                $this->error("The story data at [$publishedPath/$filename] already exists.");

                return 1;

                // $copyFile = $this->confirm("[$publishedPath/$filename] already exists. Overwrite? This cannot be undone.", false);
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
