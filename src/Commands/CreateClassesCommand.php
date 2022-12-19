<?php

namespace PropaySystems\LaravelBaseRepositories\Commands;

use Illuminate\Console\Command;
use PropaySystems\LaravelBaseRepositories\Helpers\FileHelper;
use PropaySystems\LaravelBaseRepositories\LaravelBaseRepositories;

class CreateClassesCommand extends Command
{
    public $signature = 'base:create {name} {--s|service} {--r|repository} {--model=}';

    public $description = 'Create the relevant service or repository classes.';

    /**
     * @param LaravelBaseRepositories $laravelBaseRepositories
     */
    public function __construct(
        protected LaravelBaseRepositories $laravelBaseRepositories
    )
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $name = $this->argument('name');
        $createService = $this->option('service');
        $createRepository = $this->option('repository');
        $model = $this->option('model');

        $this->comment('Class Name: ' . $name);

        if ($createService) {
            // Service
            $this->laravelBaseRepositories->createServiceFolder(FileHelper::appendClassName($name));
            $service = $this->laravelBaseRepositories->createServiceClass(FileHelper::appendClassName($name));

            if (!$service) {
                $this->error('Service class already exist!');
            } else {
                $this->comment('Service class has been created!');
            }
        }

        if ($createRepository) {
            if (!$model) {
                $this->error('Model cannot be empty!');
            } else {

                // Interface
                $this->laravelBaseRepositories->createInterfaceFolder(FileHelper::appendClassName($name, 'Repository'));
                $interface = $this->laravelBaseRepositories->createInterfaceClass(FileHelper::appendClassName($name, 'Repository'));

                if (!$interface) {
                    $this->error('Repository interface class already exist!');
                } else {
                    $this->comment('Repository interface class has been created!');
                }

                // Repository
                $this->laravelBaseRepositories->createRepositoryFolder(FileHelper::appendClassName($name, 'Repository'));
                $repository = $this->laravelBaseRepositories->createRepositoryClass(FileHelper::appendClassName($name, 'Repository'), $interface, $model);

                if (!$repository) {
                    $this->error('Repository class already exist!');
                } else {
                    $this->comment('Repository class has been created!');
                }

                // Provider
                $provider = $this->laravelBaseRepositories->createProviderClass();

                if (!$provider) {
                    $this->error('Repository provider class already exist!');
                } else {
                    $this->comment('Repository provider class has been created/linked!');
                }

                // Provider Entries
                $providerEntries = $this->laravelBaseRepositories->addProviderEntries();

                if (!$providerEntries) {
                    $this->error('Repository provider classes could not be linked!');
                } else {
                    $this->comment('Repository provider classes has been linked!');
                }
            }
        }

        return self::SUCCESS;
    }
}
