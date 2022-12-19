<?php

namespace PropaySystems\LaravelBaseRepositories;

use PropaySystems\LaravelBaseRepositories\Commands\CreateClassesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBaseRepositoriesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-base-repositories')
            ->hasConfigFile()
            ->hasCommand(CreateClassesCommand::class);
    }
}
