<?php

namespace Tests\Data;

use Andrewalf\ServiceProvider;

/**
 * SP that logs actions order.
 * A simple test-double spy realisation
 */
class ServiceProviderSpy extends ServiceProvider
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