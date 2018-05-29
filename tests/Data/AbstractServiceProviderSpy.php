<?php

namespace Andrewalf\ServiceProviders\Tests\Data;

use Andrewalf\AbstractServiceProvider;

/**
 * SP that logs actions order.
 * A simple test-double spy realisation
 */
class AbstractServiceProviderSpy extends AbstractServiceProvider
{
    private $methodCalls = [];

    public function register(): void
    {
        $this->methodCalls[] = 'register';
    }

    public function boot(): void
    {
        $this->methodCalls[] = 'boot';
    }

    public function getMethodCalls()
    {
        return $this->methodCalls;
    }
}
