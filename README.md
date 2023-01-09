# Base elequent repositories with interfaces for common queries.

[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/propaysystems/laravel-base-repositories/run-tests?label=tests)](https://github.com/propaysystems/laravel-base-repositories/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/propaysystems/laravel-base-repositories/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/propaysystems/laravel-base-repositories/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

# UNDER DEVELOPMENT AND TESTING - WE WILL ADD PROPER DOCUMENTATION WITH v1 STABLE RELEASE

This is the base classes for the repository pattern we use. In your own repository classes you have to extend the BaseRepository and implement your custom 
interface. In your custom interface you have to extend the BaseRepositoryInterface. This will give you a collection of commonly used queries and function 
that you don't need to duplicate each time. 

```php
class AddressRepository extends BaseRepository implements AddressRepositoryInterface
````
```php
interface AddressRepositoryInterface extends BaseRepositoryInterface
````

## Requirements

PHP 8.0+ \
Laravel 7+

## Installation

You can install the package via composer:

```bash
composer require propaysystems/laravel-base-repositories
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-base-repositories-config"
```

# Configuration

We create the service and repositories in the app folder of laravel to make use of laravels auto loading functionality.

## Service

The default path for createing services will be in the `App\Services` folder. If the folder does not exist it will be created.

If you want to overwrite default path for the service you can add a `ENV` variable and specify your custom path.

```bash [php]
BASE_SERVICE_PATH="App\MyServiceFolder"
```

The base name that will be appended to the class that is created by default, it will append `Service`. So if you create a `User -s`
service the file that gets created will be `UserService`

```bash [php]
APPEND_SERVICE_NAME="Service"
```

## Repository

The default path for createing repositories will be in the `App\Repositories` folder. If the folder does not exist it will be created.

If you want to overwrite default path for the repository you can add a `ENV` variable and specify your custom path.

```bash [php]
BASE_REPOSITORY_PATH="App\MyRepositoryFolder"
```

The base name that will be appended to the class that is created by default, it will append `Repository`. So if you create a `User -r`
service the file that gets created will be `UserRepository` & `UserRepositoryInterface`

```bash [php]
APPEND_REPOSITORY_NAME="Repository"
```

# Usage

## Creating a Service

The service class is where all the domain logic will be created. This makes it easier to reuse business logic in the controllers, API, commands etc

1. Creating a service class:

```bash [php]
php artisan base:create Users/User --service
or
php artisan base:create Users/User -s
```

Running this command will create a new service class in the `App\Services\` folders.

The rule is to split every service into its own related folders so the above command will actually create a file in:

- `App\Services\Users\UserService.php`

### Injecting a Repository

> :grey_exclamation: Remember to dependancy inject your repositories you want to use into the `__construct` method of your service like the example below.

```bash [php]
PHP 8.1 & above using constructor promotion
public function __construct(
    protected UserRepositoryInterface $userRepository,
)
{}

or 

PHP 8.0 & below
protected UserRepositoryInterface $userRepository;

public function __construct(
    UserRepositoryInterface $userRepository,
)
{
    $this->userRepository = $userRepository;
}
```

## Creating a Repository

1. Creating a repository class:

```bash [php]
php artisan base:create Users/User --repository --model=App/Models/Users/User
or
php artisan base:create Users/User -r --model=App/Models/Users/User
```

Running this command will create a repository class with its related interface in the `App\Repositories` & `App\Repository\UserRepository\Interfaces` folder.
Specifying the model with auto link the relevant model to the repository. In this case the User model will be added to the construct methof of the repository.

Same as the service class the rule is to split each repository into its own related folders so the above command will create files in:

- `App\Repositories\Users\UserRepositories.php`
- `App\Repositories\Users\Interfaces\UserRepositoriesInterface.php`

This will also try create and register the class and interface in laravel.

> :grey_exclamation: These command flags can be combined `-s -r` so that the related service and repository classes be created in one command.

### First Repository

After creating your first repository a `RepositoryServiceProvider.php` file will automatically be created in your `App\Providers` folder. You will need to add
the repository provider file to your `config/app.php` under the `providers` section. This will tell laravel that you are adding repositories and linking interfaces
to them and they be autoloaded.

```bash [php]
...

/*
 * Package Service Providers...
 */
App\Providers\RepositoryServiceProvider::class,

...        
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
