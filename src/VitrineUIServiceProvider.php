<?php

namespace A17\VitrineUI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use A17\VitrineUI\Commands\PublishComponent;


final class VitrineUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/vitrine-ui.php', 'vitrine-ui');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishComponent::class,
            ]);
        }
    }

    public function boot(): void
    {
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootPublishing();
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'vitrine-ui');
    }

    private function bootBladeComponents(): void
    {
        $prefix = 'vui';
        $assets = config('vitrine-ui.assets', []);
        $variations = [
            'vitrine-ui::components.button.primary' => 'button-primary',
            'vitrine-ui::components.button.secondary' => 'button-secondary',
            'vitrine-ui::components.button.icon' => 'button-icon',
            'vitrine-ui::components.link.primary' => 'link-primary',
            'vitrine-ui::components.link.secondary' => 'link-secondary',
            'vitrine-ui::components.icon._output' => 'icon-output',
            'vitrine-ui::components.icon.sprite' => 'icon-sprite',
        ];

        /** @var BladeComponent $component */
        foreach (config('vitrine-ui.components', []) as $alias => $component) {
            Blade::component($component, $alias, $prefix);

            // $this->registerAssets($component, $assets);
        }

        Blade::components($variations, $prefix);
    }

    private function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/vitrine-ui.php' => $this->app->configPath('vitrine-ui.php'),
            ], 'vitrine-ui-config');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/vitrine-ui'),
            ], 'vitrine-ui-views');
        }
    }
}
