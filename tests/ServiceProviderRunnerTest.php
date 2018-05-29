<?php

namespace Andrewalf\ServiceProviders\Tests;

use Andrewalf\Exceptions\ServiceProviderClassNotFound;
use Andrewalf\Exceptions\ServiceProviderContractNotImplementedException;
use Andrewalf\ServiceProviderRunner;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Tests\Data\AbstractServiceProviderSpy;
use Tests\Data\WrongServiceProvider;

class ServiceProviderRunnerTest extends TestCase
{
    /**
     * Test that provider runner throws exception if class not implementing
     * sp interface passed
     */
    public function testRunProvidersWrongInputContractNotImplemented()
    {
        $providers = [
            WrongServiceProvider::class,
            CorrectServiceProvider::class,
        ];

        $providerRunner = $this->createRunner($providers);

        $this->expectException(ServiceProviderContractNotImplementedException::class);

        $providerRunner->runProviders();
    }

    /**
     * Test that provider runner throws exception if class not implementing
     * sp interface passed
     */
    public function testRunProvidersWrongInputClassNotFound()
    {
        $providers = [
            RandomClass::class,
            AbstractServiceProviderSpy::class,
        ];

        $providerRunner = $this->createRunner($providers);

        $this->expectException(ServiceProviderClassNotFound::class);

        $providerRunner->runProviders();
    }

    /**
     * Test that if input is correct, service provider's methods called
     * in correct order: first 'register' and then 'boot'
     */
    public function testRunProvidersCorrectInput()
    {
        # arrange
        $serviceProviderSpy = new AbstractServiceProviderSpy();
        $containerMock = $this->getMockBuilder(ContainerInterface::class)->getMock();

        $runnerMock = $this->getMockBuilder(ServiceProviderRunner::class)
            ->setMethods(['createProviders'])
            ->setConstructorArgs([$containerMock, []])
            ->getMock();

        $runnerMock->expects($this->once())
            ->method('createProviders')
            ->will(
                $this->returnValue([$serviceProviderSpy])
            );

        # act
        $runnerMock->runProviders();

        # assert
        $this->assertEquals([
            'register',
            'boot'
        ], $serviceProviderSpy->getMethodCalls());
    }

    /**
     * Just a runner factory.
     *
     * @param array $providers
     * @return ServiceProviderRunner
     */
    protected function createRunner(array $providers)
    {
        $containerMock = $this->getMockBuilder(ContainerInterface::class)->getMock();
        return new ServiceProviderRunner($containerMock, $providers);
    }
}
