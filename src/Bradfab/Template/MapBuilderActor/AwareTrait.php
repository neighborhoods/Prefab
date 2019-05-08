<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\MapBuilderActorInterface;

trait AwareTrait
{
    protected $MapBuilderActor;

    public function setMapBuilderActor(MapBuilderActorInterface $MapBuilderActor): self
    {
        if ($this->hasMapBuilderActor()) {
            throw new \LogicException('MapBuilderActor is already set.');
        }
        $this->MapBuilderActor = $MapBuilderActor;

        return $this;
    }

    protected function getMapBuilderActor(): MapBuilderActorInterface
    {
        if (!$this->hasMapBuilderActor()) {
            throw new \LogicException('MapBuilderActor is not set.');
        }

        return $this->MapBuilderActor;
    }

    protected function hasMapBuilderActor(): bool
    {
        return isset($this->MapBuilderActor);
    }

    protected function unsetMapBuilderActor(): self
    {
        if (!$this->hasMapBuilderActor()) {
            throw new \LogicException('MapBuilderActor is not set.');
        }
        unset($this->MapBuilderActor);

        return $this;
    }
}
