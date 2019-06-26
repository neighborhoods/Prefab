<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface MapActorInterface
{
    public const MAP_KEY = 'Map';

    public const MAP_ACTOR_KEY = 'Map.php';
    public const MAP_INTERFACE_ACTOR_KEY = 'MapInterface.php';
    public const MAP_SERVICE_FILE_ACTOR_KEY = 'Map.service.yml';

    public function getActorConfiguration() : array;
}
