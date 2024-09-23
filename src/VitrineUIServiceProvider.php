<?php

namespace A17\VitrineUI;

use Illuminate\Support\ServiceProvider;
use A17\VitrineUI\Commands\PublishComponent;
use Illuminate\View\Compilers\BladeCompiler;

final class VitrineUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vitrine-ui.php', 'vitrine-ui');

        if ($this->app->runningInConsole()) {
            $this->commands([PublishComponent::class]);
        }
    }

    public function boot(): void
    {
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootPublishing();
        $this->bootTranslations();
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'vitrine-ui');
    }

    private function bootTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'vitrine-ui');
    }

    private function bootBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $prefix = config('vitrine-ui.prefix', 'vui');

            $variations = [
                'vitrine-ui::components.accordion.item' => 'accordion-item',
                'vitrine-ui::components.media.img' => 'img',
                'vitrine-ui::components.media.picture' => 'picture',
                'vitrine-ui::components.icon._output' => 'icon-output',
                'vitrine-ui::components.icon.sprite' => 'icon-sprite',
            ];

            foreach (config('vitrine-ui.components', []) as $alias => $component) {
                $blade->component($component, $alias, $prefix);
            }

            $blade->components($variations, $prefix);
        });
    }

    private function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/vitrine-ui.php' => $this->app->configPath('vitrine-ui.php'),
                ],
                'vitrine-ui-config',
            );

            $this->publishes(
                [
                    __DIR__ . '/../resources/views' => $this->app->resourcePath('views/vendor/vitrine-ui'),
                ],
                'vitrine-ui-views',
            );
        }
    }
}
