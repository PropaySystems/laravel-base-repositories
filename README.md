# Base elequent repositories with interfaces for common queries.

[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/propaysystems/laravel-base-repositories/run-tests?label=tests)](https://github.com/propaysystems/laravel-base-repositories/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/propaysystems/laravel-base-repositories/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/propaysystems/laravel-base-repositories/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

This is the base classes for the repository pattern we use. In your own repository class you have to extend the BaseRepository and implement your custom interface. In your custom interface you have to extend the BaseRepositoryInterface
```php
class AddressRepository extends BaseRepository implements AddressRepositoryInterface
````
```php
interface AddressRepositoryInterface extends BaseRepositoryInterface
````

## Installation

You can install the package via composer:

```bash
composer require propaysystems/laravel-base-repositories
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-base-repositories-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-base-repositories-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-base-repositories-views"
```

## Usage

```php
$laravelBaseRepositories = new PropaySystems\LaravelBaseRepositories();
echo $laravelBaseRepositories->echoPhrase('Hello, PropaySystems!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ettienne Louw](https://github.com/PropaySystems)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
