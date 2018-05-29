<?php

namespace Andrewalf\ServiceProviders\Providers;

use Andrewalf\ServiceProviders\AbstractServiceProvider;

/**
 * Register all app routes in simple and intuitive way.
 */
class RouteServiceProvider extends AbstractServiceProvider
{
    /**
     * Register dependencies in container.
     * Don't forget to call parent's register method.
     */
    public function register(): void
    {
        // $app var is user inside required file
        $app = $this->container->get('app');

        // These routes all receive session state.
        require './../routes/web.php';

        // These routes are typically stateless.
        require './../routes/api.php';
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
