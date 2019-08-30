<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface MapBuilderActorInterface
{
    public const MAP_BUILDER_KEY = 'Map\Builder';

    public const MAP_BUILDER_ACTOR_KEY = 'Map\Builder.php';
    public const MAP_BUILDER_INTERFACE_ACTOR_KEY = 'Map\BuilderInterface.php';
    public const MAP_BUILDER_SERVICE_FILE_ACTOR_KEY = 'Map\Builder.service.yml';

    public function getActorConfiguration() : array;
    public function setIdentityField($identity_field) : MapBuilderActorInterface;
}
