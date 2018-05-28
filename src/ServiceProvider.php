<?php

namespace Andrewalf;

use Andrewalf\Contracts\ServiceProviderContract;
use Psr\Container\ContainerInterface;

/**
 * You should extend this class for your custom service providers.
 * This class saves psr11 di container, user in register and boot methods.
 * This was done just for convenience, for keeping register and boot
 * methods signatures clear from params and easy to extend
 */
abstract class ServiceProvider implements ServiceProviderContract
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}