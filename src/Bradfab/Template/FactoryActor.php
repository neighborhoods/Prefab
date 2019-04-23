<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class FactoryActor
{
    public const FACTORY_NO_PHP = 'Factory'; //todo what to name this

    public const FACTORY_ACTOR_KEY = 'Factory.php';
    public const FACTORY_INTERFACE_ACTOR_KEY = 'FactoryInterface.php';
    public const FACTORY_SERVICE_FILE_ACTOR_KEY = 'Factory.service.yml';

    public function getActorConfiguration() : array
    {
        return
        [
            self::FACTORY_ACTOR_KEY => $this->getFactoryActor(),
            self::FACTORY_INTERFACE_ACTOR_KEY => $this->getFactoryInterfaceActor(),
            self::FACTORY_SERVICE_FILE_ACTOR_KEY => $this->getFactoryServiceFileActory(),
            self::FACTORY_NO_PHP . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY]
        ];
    }

    protected function getFactoryActor() : ?array
    {
        return null;
    }

    protected function getFactoryInterfaceActor() : ?array
    {
        return null;
    }

    protected function getFactoryServiceFileActory() : ?array
    {
        return null;
    }
}
