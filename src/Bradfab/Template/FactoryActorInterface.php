<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface FactoryActorInterface
{
    public const FACTORY_ACTOR = 'Factory';

    public const FACTORY_ACTOR_KEY = 'Factory.php';
    public const FACTORY_INTERFACE_ACTOR_KEY = 'FactoryInterface.php';
    public const FACTORY_SERVICE_FILE_ACTOR_KEY = 'Factory.service.yml';

    public function getActorConfiguration() : array;

    public function setKeyPrefix(string $key_prefix) : FactoryActorInterface;
}
