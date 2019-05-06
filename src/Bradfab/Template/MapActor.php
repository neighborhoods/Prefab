<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class MapActor
{
    public const MAP_KEY = 'Map'; 

    public const MAP_ACTOR_KEY = 'Map.php';
    public const MAP_INTERFACE_ACTOR_KEY = 'MapInterface.php';
    public const MAP_SERVICE_FILE_ACTOR_KEY = 'Map.service.yml';

    protected $key_prefix;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::MAP_ACTOR_KEY => $this->getMapActor(),
                self::MAP_INTERFACE_ACTOR_KEY => $this->getMapInterfaceActor(),
                self::MAP_SERVICE_FILE_ACTOR_KEY => $this->getMapServiceFileActor(),
                self::MAP_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY]
            ];

        $config = array_merge($config, (new MapBuilderActor())->getActorConfiguration());
        $config = array_merge($config, (new FactoryActor())->setKeyPrefix(self::MAP_KEY)->getActorConfiguration());

        return $config;
    }

    protected function getMapActor() : ?array
    {
        return null;
    }

    protected function getMapInterfaceActor() : ?array
    {
        return null;
    }

    protected function getMapServiceFileActor() : ?array
    {
        return null;
    }
}
