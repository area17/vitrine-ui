<?php

namespace A17\VitrineUI;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\ComponentAttributeBag;
use A17\VitrineUI\Commands\PublishComponent;
use Illuminate\View\Compilers\BladeCompiler;
use TalesFromADev\TailwindMerge\TailwindMerge;

final class VitrineUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vitrine-ui.php', 'vitrine-ui');

        $this->app->singleton(TailwindMerge::class, fn() => new TailwindMerge(config('vitrine-ui.tailwind_merge', [])));

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
        $this->bootTailwindMerge();
    }

    // Merges class lists (strings, lists or ['class' => bool]) with the bag's class attribute; the bag's class wins.
    private function bootTailwindMerge(): void
    {
        ComponentAttributeBag::macro('twMerge', function (...$classes) {
            /** @var ComponentAttributeBag $this */
            $this->offsetSet(
                'class',
                app(TailwindMerge::class)->merge(
                    ...array_map(fn($c) => is_array($c) ? Arr::toCssClasses($c) : $c, $classes),
                    ...[$this->get('class', '')],
                ),
            );

            return $this;
        });
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

            $variations = [];
            // Blade components without class
            foreach (config('vitrine-ui.blade-components', []) as $alias => $path) {
                $variations['vitrine-ui::' . $path] = $alias;
            }

            // Blade components with class
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
