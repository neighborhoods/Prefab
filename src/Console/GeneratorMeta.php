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

    public function getActorFilepath(): string
    {
        if ($this->actorFilePath === null) {
            throw new \LogicException('GeneratorMeta actorFilePath has not been set.');
        }
        return $this->actorFilePath;
    }

    public function setActorFilepath(string $actorFilePath): GeneratorMetaInterface
    {
        if ($this->actorFilePath !== null) {
            throw new \LogicException('GeneratorMeta actorFilePath is already set.');
        }
        $this->actorFilePath = $actorFilePath;
        return $this;
    }


}
