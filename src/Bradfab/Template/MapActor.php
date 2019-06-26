<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class MapActor implements MapActorInterface
{
    use FactoryActor\Factory\AwareTrait;
    use MapBuilderActor\Factory\AwareTrait;

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

        $config = array_merge(
            $config,
            $this->getMapBuilderActorFactory()->create()
                ->getActorConfiguration()
        );

        $config = array_merge(
            $config,
            $this->getFactoryActorFactory()->create()
                ->setKeyPrefix(self::MAP_KEY)->getActorConfiguration()
        );

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
