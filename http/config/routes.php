<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

return function (Definition $applicationServiceDefinition, ContainerBuilder $containerBuilder): void {
    // mv1/blip
//    $handlerServiceDefinition = $containerBuilder->findDefinition('neighborhoods.~~PROJECT NAME~~.mv1.blip.handler');
//    $applicationServiceDefinition->addMethodCall('get', ['/mv1/blip/{id:\d+}', $handlerServiceDefinition, 'blip']);
//    $applicationServiceDefinition->addMethodCall('get', ['/mv1/blips', $handlerServiceDefinition, 'blips']);
};
