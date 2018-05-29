<?php

namespace Andrewalf\ServiceProviders\Providers;

use Andrewalf\ServiceProviders\AbstractServiceProvider;

/**
 * Here you can register all common components and services.
 */
class AppAbstractServiceProvider extends AbstractServiceProvider
{
    /**
     * Register dependencies in container.
     * Don't forget to call parent's register method.
     */
    public function register(): void
    {
        // example with monolog

        /* $this->container['logger'] = function ($c) {
            $logger = new Logger([...]);
            return $logger;
        }; */
    }

    /**
     * Here you can configure all services in
     * DI container. For example, add event listeners
     * to global event dispatcher.
     */
    public function boot(): void
    {

    }
}
