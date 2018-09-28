<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilder\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ActorMapBuilderGenerator;

    public function setActorMapBuilderGenerator(GeneratorInterface $ActorMapBuilderGenerator) : self
    {
        if ($this->hasActorMapBuilderGenerator()) {
            throw new \LogicException('ActorMapBuilderGenerator is already set.');
        }
        $this->ActorMapBuilderGenerator = $ActorMapBuilderGenerator;

        return $this;
    }

    protected function getActorMapBuilderGenerator() : GeneratorInterface
    {
        if (!$this->hasActorMapBuilderGenerator()) {
            throw new \LogicException('ActorMapBuilderGenerator is not set.');
        }

        return $this->ActorMapBuilderGenerator;
    }

    protected function hasActorMapBuilderGenerator() : bool
    {
        return isset($this->ActorMapBuilderGenerator);
    }

    protected function unsetActorMapBuilderGenerator() : self
    {
        if (!$this->hasActorMapBuilderGenerator()) {
            throw new \LogicException('ActorMapBuilderGenerator is not set.');
        }
        unset($this->ActorMapBuilderGenerator);

        return $this;
    }
}
