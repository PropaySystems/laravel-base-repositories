<?php

namespace PropaySystems\LaravelBaseRepositories\Helpers;

use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function splitFile(string $file): array
    {
        $pathParts = explode(DIRECTORY_SEPARATOR, $file);

        $fileName = end($pathParts);
        $path = str_replace(DIRECTORY_SEPARATOR.$fileName, '', $file);

        return [
            'path' => $path,
            'file' => $fileName.'.php',
            'fileName' => $fileName,
        ];
    }

    public static function createDirectory(string $path): string
    {
        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        return $path;
    }

    public static function convertBackslash(string $string): string
    {
        return str_replace('/', '\\', $string);
    }

    public static function buildNamespace(string $string): string
    {
        return rtrim(self::convertBackslash(ucfirst(str_replace('.php', '', $string))), '\\');
    }

    public static function stripPhp(string $string, string $replace = ''): string
    {
        return str_replace('.php', $replace, $string);
    }

    public static function appendClassName(string $name, string $class = 'Service'): string
    {
        return str_replace($class, '', $name).$class;
    }
}
