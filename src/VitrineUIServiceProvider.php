<?php

namespace A17\VitrineUI;

use A17\VitrineUI\Components\Button;
use A17\VitrineUI\Components\Heading;
use A17\VitrineUI\Components\Modal;
use Spatie\LaravelPackageTools\Package;
use A17\VitrineUI\Commands\VitrineUICommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VitrineUIServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('vitrine-ui')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponents('vui', Button::class)
            ->hasViewComponents('vui', Heading::class)
            ->hasViewComponents('vui', Modal::class)
            ->hasCommand(VitrineUICommand::class);
    }
}
