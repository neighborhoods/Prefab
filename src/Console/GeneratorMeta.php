<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

class GeneratorMeta implements GeneratorMetaInterface
{
    /** @var string */
    protected $actorNamespace;
    /** @var string */
    protected $actorFilePath;
    /** @var string */
    protected $daoName;
    /** @var array */
    protected $daoProperties;

    public function getDaoProperties() : array
    {
        if ($this->daoProperties === null) {
            throw new \LogicException('GeneratorMeta daoProperties has not been set.');
        }
        return $this->daoProperties;
    }

    public function setDaoProperties(array $daoProperties) : GeneratorMetaInterface
    {
        if ($this->daoProperties !== null) {
            throw new \LogicException('GeneratorMeta daoProperties is already set.');
        }
        $this->daoProperties = $daoProperties;
        return $this;
    }

    public function getActorNamespace(): string
    {
        if ($this->actorNamespace === null) {
            throw new \LogicException('GeneratorMeta actorNamespace has not been set.');
        }
        return $this->actorNamespace;
    }

    public function setActorNamespace(string $actorNamespace): GeneratorMetaInterface
    {
        if ($this->actorNamespace !== null) {
            throw new \LogicException('GeneratorMeta actorNamespace is already set.');
        }
        $this->actorNamespace = $actorNamespace;
        return $this;
    }

    public function getActorFilePath(): string
    {
        if ($this->actorFilePath === null) {
            throw new \LogicException('GeneratorMeta actorFilePath has not been set.');
        }
        return $this->actorFilePath;
    }

    public function setActorFilePath(string $actorFilePath): GeneratorMetaInterface
    {
        if ($this->actorFilePath !== null) {
            throw new \LogicException('GeneratorMeta actorFilePath is already set.');
        }
        $this->actorFilePath = $actorFilePath;
        return $this;
    }

    public function getDaoName(): string
    {
        if ($this->daoName === null) {
            throw new \LogicException('GeneratorMeta daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName): GeneratorMetaInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('GeneratorMeta daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }


}
