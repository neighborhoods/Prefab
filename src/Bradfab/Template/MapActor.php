<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class MapActor implements MapActorInterface
{
    use FactoryActor\Factory\AwareTrait;
    use MapBuilderActor\Factory\AwareTrait;

    protected $key_prefix;
    protected $identity_field;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::MAP_ACTOR_KEY => $this->getMapActor(),
                self::MAP_INTERFACE_ACTOR_KEY => $this->getMapInterfaceActor(),
                self::MAP_SERVICE_FILE_ACTOR_KEY => $this->getMapServiceFileActor(),
                self::MAP_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY]
            ];

        $mapBuilderActor = $this->getMapBuilderActorFactory()->create();

        if ($this->hasIdentityField()) {
            $mapBuilderActor->setIdentityField($this->getIdentityField());
        }

        $config = array_merge(
            $config,
            $mapBuilderActor->getActorConfiguration()
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

    protected function getIdentityField()
    {
        if ($this->identity_field === null) {
            throw new \LogicException('MapBuilderActor identity_field has not been set.');
        }
        return $this->identity_field;
    }

    public function setIdentityField($identity_field) : MapActorInterface
    {
        if ($this->identity_field !== null) {
            throw new \LogicException('MapBuilderActor identity_field is already set.');
        }
        $this->identity_field = $identity_field;
        return $this;
    }

    protected function hasIdentityField() : bool
    {
        return $this->identity_field !== null;
    }
}
