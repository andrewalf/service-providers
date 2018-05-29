<?php

namespace Andrewalf\ServiceProviders;

use Andrewalf\ServiceProviders\Contracts\ServiceProviderContract;
use Andrewalf\ServiceProviders\Exceptions\ServiceProviderClassNotFound;
use Andrewalf\ServiceProviders\Exceptions\ServiceProviderContractNotImplementedException;
use Psr\Container\ContainerInterface;

/**
 * This class gets a list of service providers,
 * iterates through them and calls register and then
 * boot methods.
 */
class ServiceProviderRunner
{
    /**
     * PSR11 DI container
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Array of providers
     *
     * @var array
     */
    private $providers;

    public function __construct(ContainerInterface $container, array $providers)
    {
        $this->container = $container;
        $this->providers = $providers;
    }

    /**
     * Creates providers and runs register and then
     * boot methods.
     */
    public function runProviders(): void
    {
        $providers = $this->createProviders($this->providers);

        /**
         * @var $provider ServiceProviderContract
         */
        foreach ($providers as $provider) {
            $provider->register();
        }

        foreach ($providers as $provider) {
            $provider->boot();
        }
    }

    /**
     * Gets an array of providers namespaces, creates objects,
     * checks them if the implement the service providers contract.
     *
     * @param array $providers
     * @return array
     * @throws ServiceProviderClassNotFound
     * @throws ServiceProviderContractNotImplementedException
     */
    protected function createProviders(array $providers): array
    {
        $createdProviders = [];

        foreach ($providers as $providerNamespace) {
            try {
                $provider = new $providerNamespace();
            } catch (\Error $error) {
                # if autoload failed loading the class
                throw new ServiceProviderClassNotFound($providerNamespace);
            }

            if (!$provider instanceof ServiceProviderContract) {
                throw new ServiceProviderContractNotImplementedException($providerNamespace);
            }

            $provider->setContainer($this->container);
            $createdProviders[$providerNamespace] = $provider;
        }

        return $createdProviders;
    }
}
