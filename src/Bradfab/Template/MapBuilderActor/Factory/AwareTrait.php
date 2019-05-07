<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor\FactoryInterface;

trait AwareTrait
{
    protected $MapBuilderActorFactory;

    public function setMapBuilderActorFactory(FactoryInterface $MapBuilderActorFactory): self
    {
        if ($this->hasMapBuilderActorFactory()) {
            throw new \LogicException('MapBuilderActorFactory is already set.');
        }
        $this->MapBuilderActorFactory = $MapBuilderActorFactory;

        return $this;
    }

    protected function getMapBuilderActorFactory(): FactoryInterface
    {
        if (!$this->hasMapBuilderActorFactory()) {
            throw new \LogicException('MapBuilderActorFactory is not set.');
        }

        return $this->MapBuilderActorFactory;
    }

    protected function hasMapBuilderActorFactory(): bool
    {
        return isset($this->MapBuilderActorFactory);
    }

    protected function unsetMapBuilderActorFactory(): self
    {
        if (!$this->hasMapBuilderActorFactory()) {
            throw new \LogicException('MapBuilderActorFactory is not set.');
        }
        unset($this->MapBuilderActorFactory);

        return $this;
    }
}
