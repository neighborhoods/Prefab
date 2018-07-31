<?php
declare(strict_types=1);

// @team - delete me
use Neighborhoods\ReplaceWithYourProductName\MV1;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

return function (Definition $applicationServiceDefinition, ContainerBuilder $containerBuilder): void {
    // @team - delete me
    // mv1/DAO example
//    $mv1DAOHandlerServiceDefinition = $containerBuilder->findDefinition(MV1\DAO\HandlerInterface::class);
//    $applicationServiceDefinition->addMethodCall(
//        'get',
//        ['/mv1/dao/{id:\d+}', $mv1DAOHandlerServiceDefinition, 'dao']
//    );

    // @team - delete me
    // mv1/DAOs example
//    $applicationServiceDefinition->addMethodCall(
//        'getMapByUris',
//        ['/mv1/daos/{uris:}', $mv1DAOHandlerServiceDefinition, 'daos']
//    );
};