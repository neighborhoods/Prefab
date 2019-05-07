<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Collection;

use Neighborhoods\Prefab\SupportingActorGroup\CollectionInterface;

trait AwareTrait
{
    protected $Collection;

    public function setCollection(CollectionInterface $Collection): self
    {
        if ($this->hasCollection()) {
            throw new \LogicException('Collection is already set.');
        }
        $this->Collection = $Collection;

        return $this;
    }

    protected function getCollection(): CollectionInterface
    {
        if (!$this->hasCollection()) {
            throw new \LogicException('Collection is not set.');
        }

        return $this->Collection;
    }

    protected function hasCollection(): bool
    {
        return isset($this->Collection);
    }

    protected function unsetCollection(): self
    {
        if (!$this->hasCollection()) {
            throw new \LogicException('Collection is not set.');
        }
        unset($this->Collection);

        return $this;
    }
}
