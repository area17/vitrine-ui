<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\VitrineUI;
use App\Services\OptimizedClassMerge;
use App\Services\TailwindMergeBoost;
use Exception;
use Illuminate\View\Component;

abstract class VitrineComponent extends Component
{
    protected static array $assets = [];

    public static function assets(): array
    {
        return static::$assets;
    }

    public array $ui = [];

    public function __construct(array $ui = [])
    {
        $this->ui = $ui;
    }

    public function isExternalUrl(?string $url): bool
    {
        return VitrineUI::isExternalUrl($url);
    }

    public function ui(?string $component, array|string $key = 'base', array $options = []): string
    {
        try {
            return VitrineUI::ui($component, $key, $options, $this->ui);
        } catch (Exception $e) {
            report($e);

            return '';
        }
    }

    public function preset(?string $component): array
    {
        try {
            return VitrineUI::getComponentConfig($component);
        } catch (Exception $e) {
            report($e);

            return [];
        }
    }

    public function setAttributes(array $attributes): string
    {
        return VitrineUI::setAttributes($attributes);
    }

    /**
     * Pre-merge theme classes with user-provided classes using optimized merge
     *
     * @param  string|array|null  ...$themeClasses
     */
    public function mergeClasses(...$themeClasses): string
    {
        if (config('vitrine-ui.boost', true)) {
            if (class_exists(TailwindMergeBoost::class)) {
                $boostService = new TailwindMergeBoost;

                return $boostService->merge(...$themeClasses);
            }
        }

        if (config('vitrine-ui.optimized_merge', false) && class_exists(OptimizedClassMerge::class)) {
            return OptimizedClassMerge::merge(...$themeClasses);
        }

        // Fallback to twMerge if optimized merge is disabled
        if (function_exists('twMerge')) {
            return twMerge(...$themeClasses);
        }

        // Last resort: simple concatenation
        return trim(implode(' ', array_filter(array_map(fn ($c) => is_array($c) ? implode(' ', $c) : $c, $themeClasses))));
    }
}
