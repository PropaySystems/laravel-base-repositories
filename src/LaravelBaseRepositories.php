<?php

namespace PropaySystems\LaravelBaseRepositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PropaySystems\LaravelBaseRepositories\Helpers\FileHelper;

class LaravelBaseRepositories
{
    public function createServiceFolder(string $file): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_service_path').$parts['path'];

        FileHelper::createDirectory($folderPath);

        return $folderPath;
    }

    public function createServiceClass(string $file): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_service_path').$parts['path'];
        $fullPath = $folderPath.DIRECTORY_SEPARATOR.$parts['file'];

        if (! File::exists($fullPath)) {
            $content = File::get(base_path('vendor/propaysystems/laravel-base-repositories/stubs/service.stub'));
            File::put($fullPath, $this->replaceVariables($content, FileHelper::buildNamespace($folderPath), $parts['fileName']));
        } else {
            return false;
        }

        return $fullPath;
    }

    public function createInterfaceFolder(string $file): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_repository_path').$parts['path'].DIRECTORY_SEPARATOR.config('base-repositories.base_interface_path');

        FileHelper::createDirectory($folderPath);

        return $folderPath;
    }

    public function createInterfaceClass(string $file): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_repository_path').$parts['path'].DIRECTORY_SEPARATOR.config('base-repositories.base_interface_path');
        $fullPath = $folderPath.DIRECTORY_SEPARATOR.FileHelper::stripPhp($parts['file'].'Interface').'.php';

        if (! File::exists($fullPath)) {
            $contents = File::get(base_path('vendor/propaysystems/laravel-base-repositories/stubs/interface.stub'));
            File::put($fullPath, $this->replaceVariables($contents, FileHelper::buildNamespace($folderPath), $parts['fileName'].'Interface'));
        } else {
            return false;
        }

        return $fullPath;
    }

    public function createRepositoryFolder(string $file): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_repository_path').$parts['path'];

        FileHelper::createDirectory($folderPath);

        return $folderPath;
    }

    public function createRepositoryClass(string $file, string $interfacePath, string $model): bool|string
    {
        $parts = FileHelper::splitFile($file);
        $folderPath = config('base-repositories.base_repository_path').$parts['path'];
        $fullPath = $folderPath.DIRECTORY_SEPARATOR.$parts['file'];

        if (! File::exists($fullPath)) {
            $contents = File::get(base_path('vendor/propaysystems/laravel-base-repositories/stubs/repository.stub'));
            File::put($fullPath, $this->replaceVariables(
                $contents,
                FileHelper::buildNamespace($folderPath),
                $parts['fileName'],
                FileHelper::stripPhp(FileHelper::splitFile($interfacePath)['fileName']),
                FileHelper::buildNamespace($interfacePath),
                '\\'.FileHelper::buildNamespace($model)
            ));
        } else {
            return false;
        }

        return $fullPath;
    }

    public function createProviderClass(): string
    {
        $fullPath = app_path('Providers/RepositoryServiceProvider.php');

        if (! File::exists($fullPath)) {
            File::put($fullPath, File::get(base_path('vendor/propaysystems/laravel-base-repositories/stubs/provider.stub')));
        }

        return $fullPath;
    }

    public function addProviderEntries(): bool
    {
        File::directories(config('base-repositories.base_repository_path'));

        $contents = '';
        foreach (File::directories(config('base-repositories.base_repository_path')) as $directory) {
            $baseInterfacePath = $directory.DIRECTORY_SEPARATOR.config('base-repositories.base_interface_path').DIRECTORY_SEPARATOR;

            foreach (File::files($directory) as $repository) {
                $parts = FileHelper::splitFile($repository);

                $interfacePath = FileHelper::convertBackslash(ucfirst($baseInterfacePath.FileHelper::stripPhp($parts['fileName']).'Interface::class'));
                $repositoryPath = FileHelper::convertBackslash(ucfirst(FileHelper::stripPhp($repository, '::class')));

                $contents .= "        \$this->app->bind(\\$interfacePath, \\$repositoryPath);".PHP_EOL;
            }
        }

        $builtContent = str_replace('{text_here}', $contents, File::get(base_path('vendor/propaysystems/laravel-base-repositories/stubs/provider.stub')));

        File::put(app_path('Providers/RepositoryServiceProvider.php'), $builtContent);

        return true;
    }

    /**
     * @param  null  $interface
     * @param  null  $interfacePath
     * @param  null  $model
     */
    public function replaceVariables($content, $namespace, $fileName, $interface = null, $interfacePath = null, $model = null): string
    {
        return Str::of($content)
            ->replace('{{ namespace }}', $namespace)
            ->replace('{{ interface_path }}', $interfacePath)
            ->replace('{{ interface }}', $interface)
            ->replace('{{ file }}', $fileName)
            ->replace('{{ model }}', $model);
    }
}
