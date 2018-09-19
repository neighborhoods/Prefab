<?php
declare(strict_types=1);

// @team - delete me
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\MV1;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

return function (Definition $applicationServiceDefinition, ContainerBuilder $containerBuilder): void {
    // @team - delete me
    // mv1/DAO example
//    $mv1DAOHandlerServiceDefinition = $containerBuilder->findDefinition(MV1\DAO\Repository\HandlerInterface::class);
//    $applicationServiceDefinition->addMethodCall(
//        'get',
//        ['/mv1/dao/{id:\d+}', $mv1DAOHandlerServiceDefinition, 'dao']
//    );

    // @team - delete me
    // mv1/DAOs example
//    $applicationServiceDefinition->addMethodCall(
//        'get',
//        [
//            '/mv1/daos/{searchCriteria:}',
//            $mv1DAOHandlerServiceDefinition,
//            MV1\DAO\Repository\HandlerInterface::ROUTE_NAME_DAOS
//        ]
//    );
};
