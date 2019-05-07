<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\TypedObject;

use Neighborhoods\Prefab\SupportingActorGroup\TypedObjectInterface;

trait AwareTrait
{
    protected $TypedObject;

    public function setTypedObject(TypedObjectInterface $TypedObject): self
    {
        if ($this->hasTypedObject()) {
            throw new \LogicException('TypedObject is already set.');
        }
        $this->TypedObject = $TypedObject;

        return $this;
    }

    protected function getTypedObject(): TypedObjectInterface
    {
        if (!$this->hasTypedObject()) {
            throw new \LogicException('TypedObject is not set.');
        }

        return $this->TypedObject;
    }

    protected function hasTypedObject(): bool
    {
        return isset($this->TypedObject);
    }

    protected function unsetTypedObject(): self
    {
        if (!$this->hasTypedObject()) {
            throw new \LogicException('TypedObject is not set.');
        }
        unset($this->TypedObject);

        return $this;
    }
}
