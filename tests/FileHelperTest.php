<?php

beforeEach(function () {
    $this->file = 'Users/User';
    $this->path = 'Users';
    $this->fileName = 'User';
});

test('can split namespaced name to get path', function () {
    $path = \PropaySystems\LaravelBaseRepositories\Helpers\FileHelper::splitFile($this->file);

    $this->assertStringContainsString($this->path, $path['path']);
});

test('can split namespaced name to get file', function () {
    $path = \PropaySystems\LaravelBaseRepositories\Helpers\FileHelper::splitFile($this->file);

    $this->assertStringContainsString($this->fileName . '.php', $path['file']);
});

test('can split namespaced name to get file name', function () {
    $path = \PropaySystems\LaravelBaseRepositories\Helpers\FileHelper::splitFile($this->file);

    $this->assertStringContainsString($this->fileName, $path['fileName']);
});

test('can convert path to namespace', function () {
    $path = \PropaySystems\LaravelBaseRepositories\Helpers\FileHelper::convertBackslash('App/Repositories/Users');

    $this->assertStringContainsString('App\Repositories\Users', $path);
});
