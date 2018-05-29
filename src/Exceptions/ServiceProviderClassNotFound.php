<?php

namespace Andrewalf\ServiceProviders\Exceptions;

/**
 * Exception when custom service provider doesn't
 * implement ServiceContainerContract.
 */
class ServiceProviderClassNotFound extends \Exception
{
    public function __construct(string $classNamespace, \Throwable $previous = null)
    {
        $message = 'ServiceProvider class not found by autoload: ' . $classNamespace;

        parent::__construct($message, 500, $previous);
    }
}
