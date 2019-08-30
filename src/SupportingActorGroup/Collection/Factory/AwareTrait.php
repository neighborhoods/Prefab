<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Collection\Factory;

use Neighborhoods\Prefab\SupportingActorGroup\Collection\FactoryInterface;

trait AwareTrait
{
    protected $CollectionFactory;

    public function setCollectionFactory(FactoryInterface $CollectionFactory): self
    {
        if ($this->hasCollectionFactory()) {
            throw new \LogicException('CollectionFactory is already set.');
        }
        $this->CollectionFactory = $CollectionFactory;

        return $this;
    }

    protected function getCollectionFactory(): FactoryInterface
    {
        if (!$this->hasCollectionFactory()) {
            throw new \LogicException('CollectionFactory is not set.');
        }

        return $this->CollectionFactory;
    }

    protected function hasCollectionFactory(): bool
    {
        return isset($this->CollectionFactory);
    }

    protected function unsetCollectionFactory(): self
    {
        if (!$this->hasCollectionFactory()) {
            throw new \LogicException('CollectionFactory is not set.');
        }
        unset($this->CollectionFactory);

        return $this;
    }
}
