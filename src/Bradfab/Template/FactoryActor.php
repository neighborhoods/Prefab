<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class FactoryActor
{
    public const FACTORY_NO_PHP = 'Factory'; //todo what to name this

    public const FACTORY_ACTOR_KEY = 'Factory.php';
    public const FACTORY_INTERFACE_ACTOR_KEY = 'FactoryInterface.php';
    public const FACTORY_SERVICE_FILE_ACTOR_KEY = 'Factory.service.yml';

    /** @var string */
    protected $key_prefix;

    public function getActorConfiguration() : array
    {
        $prefix = $this->hasKeyPrefix() ? $this->getKeyPrefix() . '\\' : null;
        return
        [
            $prefix . self::FACTORY_ACTOR_KEY => $this->getFactoryActor(),
            $prefix . self::FACTORY_INTERFACE_ACTOR_KEY => $this->getFactoryInterfaceActor(),
            $prefix . self::FACTORY_SERVICE_FILE_ACTOR_KEY => $this->getFactoryServiceFileActor(),
            $prefix . self::FACTORY_NO_PHP . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY]
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

    protected function getFactoryServiceFileActor() : ?array
    {
        return null;
    }

    protected function getKeyPrefix() : string
    {
        if ($this->key_prefix === null) {
            throw new \LogicException('FactoryActor key_prefix has not been set.');
        }
        return $this->key_prefix;
    }

    public function setKeyPrefix(string $key_prefix) : FactoryActor
    {
        if ($this->key_prefix !== null) {
            throw new \LogicException('FactoryActor key_prefix is already set.');
        }
        $this->key_prefix = $key_prefix;
        return $this;
    }

    protected function hasKeyPrefix() : bool
    {
        return $this->key_prefix !== null;
    }
}
