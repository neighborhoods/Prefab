<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\TypedObject\Factory;

use Neighborhoods\Prefab\SupportingActorGroup\TypedObject\FactoryInterface;

trait AwareTrait
{
    protected $TypedObjectFactory;

    public function setTypedObjectFactory(FactoryInterface $TypedObjectFactory): self
    {
        if ($this->hasTypedObjectFactory()) {
            throw new \LogicException('TypedObjectFactory is already set.');
        }
        $this->TypedObjectFactory = $TypedObjectFactory;

        return $this;
    }

    protected function getTypedObjectFactory(): FactoryInterface
    {
        if (!$this->hasTypedObjectFactory()) {
            throw new \LogicException('TypedObjectFactory is not set.');
        }

        return $this->TypedObjectFactory;
    }

    protected function hasTypedObjectFactory(): bool
    {
        return isset($this->TypedObjectFactory);
    }

    protected function unsetTypedObjectFactory(): self
    {
        if (!$this->hasTypedObjectFactory()) {
            throw new \LogicException('TypedObjectFactory is not set.');
        }
        unset($this->TypedObjectFactory);

        return $this;
    }
}
