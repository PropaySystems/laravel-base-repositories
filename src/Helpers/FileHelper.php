<?php

namespace PropaySystems\LaravelBaseRepositories\Helpers;

use Illuminate\Support\Facades\File;

class FileHelper
{
    /**
     * @param string $file
     * @return array
     */
    public static function splitFile(string $file): array
    {
        $pathParts = explode(DIRECTORY_SEPARATOR, $file);

        $fileName = end($pathParts);
        $path = str_replace($fileName, '', $file);

        return [
            'path' => $path,
            'file' => $fileName . '.php',
            'fileName' => $fileName
        ];
    }

    /**
     * @param string $path
     * @return string
     */
    public static function createDirectory(string $path): string
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        return $path;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function convertBackslash(string $string): string
    {
        return str_replace('/', '\\', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function buildNamespace(string $string): string
    {
        return rtrim(self::convertBackslash(ucfirst(str_replace('.php', '', $string))), '\\');
    }

    /**
     * @param string $string
     * @param string $replace
     * @return string
     */
    public static function stripPhp(string $string, string $replace = ''): string
    {
        return str_replace('.php', $replace, $string);
    }

    /**
     * @param string $name
     * @param string $class
     * @return string
     */
    public static function appendClassName(string $name, string $class = 'Service'): string
    {
        return str_replace($class, '', $name) . $class;
    }
}
