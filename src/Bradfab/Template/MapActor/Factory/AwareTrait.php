<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\MapActor\FactoryInterface;

trait AwareTrait
{
    protected $MapActorFactory;

    public function setMapActorFactory(FactoryInterface $MapActorFactory): self
    {
        if ($this->hasMapActorFactory()) {
            throw new \LogicException('MapActorFactory is already set.');
        }
        $this->MapActorFactory = $MapActorFactory;

        return $this;
    }

    protected function getMapActorFactory(): FactoryInterface
    {
        if (!$this->hasMapActorFactory()) {
            throw new \LogicException('MapActorFactory is not set.');
        }

        return $this->MapActorFactory;
    }

    protected function hasMapActorFactory(): bool
    {
        return isset($this->MapActorFactory);
    }

    protected function unsetMapActorFactory(): self
    {
        if (!$this->hasMapActorFactory()) {
            throw new \LogicException('MapActorFactory is not set.');
        }
        unset($this->MapActorFactory);

        return $this;
    }
}
