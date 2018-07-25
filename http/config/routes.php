<?php
declare(strict_types=1);

use Neighborhoods\~~PROJECT NAME~~\MV1;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

return function (Definition $applicationServiceDefinition, ContainerBuilder $containerBuilder): void {
    // mv1/dummy
    $mv1DummyHandlerServiceDefinition = $containerBuilder->findDefinition(MV1\Dummy\HandlerInterface::class);
    $applicationServiceDefinition->addMethodCall(
        'get',
        ['/mv1/dummy/{id:\d+}', $mv1DummyHandlerServiceDefinition, 'dummy']
    );

    // mv1/dummies
    $mv1DummyAbbreviatedHandlerServiceDefinition = $containerBuilder->findDefinition(MV1\Dummy\Abbreviated\HandlerInterface::class);
    $applicationServiceDefinition->addMethodCall(
        'get',
        ['/mv1/dummies/{uris:}', $mv1DummyAbbreviatedHandlerServiceDefinition, 'dummies']
    );
};
