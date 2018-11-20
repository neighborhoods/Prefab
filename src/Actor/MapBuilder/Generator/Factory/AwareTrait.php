<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilder\Generator\Factory;

use Neighborhoods\Prefab\Actor\MapBuilder\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ActorMapBuilderGeneratorFactory;

    public function setActorMapBuilderGeneratorFactory(FactoryInterface $actorMapBuilderGeneratorFactory) : self
    {
        if ($this->hasActorMapBuilderGeneratorFactory()) {
            throw new \LogicException('ActorMapBuilderGeneratorFactory is already set.');
        }
        $this->ActorMapBuilderGeneratorFactory = $actorMapBuilderGeneratorFactory;

        return $this;
    }

    protected function getActorMapBuilderGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasActorMapBuilderGeneratorFactory()) {
            throw new \LogicException('ActorMapBuilderGeneratorFactory is not set.');
        }

        return $this->ActorMapBuilderGeneratorFactory;
    }

    protected function hasActorMapBuilderGeneratorFactory() : bool
    {
        return isset($this->ActorMapBuilderGeneratorFactory);
    }

    protected function unsetActorMapBuilderGeneratorFactory() : self
    {
        if (!$this->hasActorMapBuilderGeneratorFactory()) {
            throw new \LogicException('ActorMapBuilderGeneratorFactory is not set.');
        }
        unset($this->ActorMapBuilderGeneratorFactory);

        return $this;
    }
}
