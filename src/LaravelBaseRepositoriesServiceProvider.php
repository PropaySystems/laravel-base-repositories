<?php

namespace PropaySystems\LaravelBaseRepositories;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PropaySystems\LaravelBaseRepositories\Commands\LaravelBaseRepositoriesCommand;

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
            ->hasConfigFile();
//            ->hasViews()
//            ->hasMigration('create_laravel-base-repositories_table')
//            ->hasCommand(LaravelBaseRepositoriesCommand::class);
    }
}
