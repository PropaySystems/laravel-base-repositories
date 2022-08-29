<?php

namespace PropaySystems\LaravelBaseRepositories\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PropaySystems\LaravelBaseRepositories\LaravelBaseRepositories
 */
class LaravelBaseRepositories extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PropaySystems\LaravelBaseRepositories\LaravelBaseRepositories::class;
    }
}
