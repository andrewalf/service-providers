# Laravel-like service containers.

This package is made for Slim, to make it's configuration a little bit better, but
you can use it in any project. This package is framework agnostic, it relies only on PSR-11
Container interface.

## Installing
```
composer require andrewalf/service_providers
```

## Running the tests
```
composer run tests
```

## Usage
1. Create `service_providers.php` file in your project's root. This file should return array of
service providers full class names.
2. In your `index.php` file require that file in a variable.
3. (*Pass this step if RouteServiceProvider is not used*) In your `index.php` file add in DI container your app instance with the "app" key.
4. Create `ServiceProviderRunner` instance, with psr-11 DI container and providers array as constructor params. 
Call it's **runProviders** method

Now you can add your custom service providers. They have two methods: **register** and **boot**.
In **register** method, which called first, you should register dependencies in the container.
In **boot** method feel free to modify and configure your app as you want. For example, you can
create *EventListenersServiceProvider* where keep all your listeners attachments.

## Usage example for Slim 3 framework.

**index.php**
```php
    $app = new \Slim\App($settings);
    $container = $app->getContainer();
    
    // we use RouteServiceProvider
    $container['app'] = function ($c) use ($app) {
        return $app;
    };
    
    $providersArray = require '../service_providers.php';
    (new \Andrewalf\ServiceProviderRunner($app->getContainer(), $providersArray))->runProviders();
```

**service_providers.php**
```php
    return [
        \Andrewalf\RouteServiceProvider::class,
        \Andrewalf\AppServiceProvider::class
    ];
```

## RouteServiceProvider

This is made mostly for Slim.
This provider loads app routes from separated files: web.php and api.php. Path to these files is
hardcoded in provider. Feel free to copy and modify it.

**TODO**: composer command for coping package providers to your providers directory.
