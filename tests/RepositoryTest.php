<?php

beforeEach(function () {
    $this->service = new \PropaySystems\LaravelBaseRepositories\LaravelBaseRepositories();
    $this->file = 'Users/User';
});

test('can service folder be created', function () {
    $path = $this->service->createServiceFolder($this->file);

    $this->assertStringContainsString(config('base-repositories.base_service_path').'Users', $path);
});

//test('can service class be created', function () {
//    $path = $this->service->createServiceClass($this->file);
//
//    $this->assertStringContainsString('Users/User.php', $path);
//});

test('can repository folder be created', function () {
    $path = $this->service->createRepositoryFolder($this->file);

    $this->assertStringContainsString(config('base-repositories.base_repository_path').'Users', $path);
});

test('can interface folder be created', function () {
    $path = $this->service->createInterfaceFolder($this->file);

    $this->assertStringContainsString('Users'.DIRECTORY_SEPARATOR.config('base-repositories.base_interface_path'), $path);
});

//test('can provider class be created', function () {
//    $path = $this->service->createProviderClass();
//
//    $this->assertStringContainsString('RepositoryServiceProvider', $path);
//});
