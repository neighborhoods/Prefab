<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface HandlerActorInterface
{
    public const HANDLER_KEY = 'Map\Repository\Handler';

    public const HANDLER_ACTOR_KEY = 'Map\Repository\Handler.php';
    public const HANDLER_INTERFACE_ACTOR_KEY = 'Map\Repository\HandlerInterface.php';
    public const HANDLER_SERVICE_FILE_ACTOR_KEY = 'Map\Repository\Handler.service.yml';

    public function getActorConfiguration() : array;

    public function setProjectName($project_name) : HandlerActorInterface;

    public function setRoutePath(string $route_path) : HandlerActorInterface;

    public function setRouteName(string $route_name) : HandlerActorInterface;
}
