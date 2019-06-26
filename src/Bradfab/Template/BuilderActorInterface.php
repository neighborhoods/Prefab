<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface BuilderActorInterface
{
    public const BUILDER_KEY = 'Builder';

    public const BUILDER_ACTOR_KEY = 'Builder.php';
    public const BUILDER_INTERFACE_ACTOR_KEY = 'BuilderInterface.php';
    public const BUILDER_SERVICE_FILE_ACTOR_KEY = 'Builder.service.yml';

    public function getActorConfiguration() : array;

    public function setProperties($properties) : BuilderActorInterface;
}
