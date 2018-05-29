<?php

namespace Andrewalf\ServiceProviders\Exceptions;

/**
 * Exception when custom service provider doesn't
 * implement ServiceContainerContract.
 */
class ServiceProviderContractNotImplementedException extends \Exception
{
    public function __construct(string $classNamespace, \Throwable $previous = null)
    {
        $message = 'ServiceProviderContract not implemented in: ' . $classNamespace;

        parent::__construct($message, 500, $previous);
    }
}
