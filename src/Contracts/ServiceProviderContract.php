<?php

namespace Andrewalf\Contracts;

use Psr\Container\ContainerInterface;

/**
 * Implement this contract for all custom
 * service providers.
 */
interface ServiceProviderContract
{
    /**
     * Register dependencies in container.
     * Don't forget to call parent's register method.
     */
    public function register(): void;

    /**
     * This method is called after all other service
     * providers have been registered
     *
     * Here you can configure all services in
     * DI container. For example, add event listeners
     * to global event dispatcher.
     */
    public function boot(): void;

    /**
     * Set PSR-11 container
     *
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container): void;
}