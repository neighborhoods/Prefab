<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip;

/** @codeCoverageIgnore */
class UpdateArray extends \ArrayIterator implements UpdateArrayInterface
{
    /** @param UpdateInterface ...$v1MVBlipUpdates */
    public function __construct(array $v1MVBlipUpdates = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('UpdateArray is not empty.');
        }

        if (!empty($v1MVBlipUpdates)) {
            $this->assertValidArrayType(...$v1MVBlipUpdates);
        }

        parent::__construct($v1MVBlipUpdates, $flags);
    }

    public function offsetGet($index): UpdateInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param UpdateInterface $v1MVBlipUpdate */
    public function offsetSet($index, $v1MVBlipUpdate)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($v1MVBlipUpdate));
    }

    /** @param UpdateInterface $v1MVBlipUpdate */
    public function append($v1MVBlipUpdate)
    {
        $this->assertValidArrayItemType($v1MVBlipUpdate);
        parent::append($v1MVBlipUpdate);
    }

    public function current(): UpdateInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(UpdateInterface $v1MVBlipUpdate)
    {
        return $v1MVBlipUpdate;
    }

    protected function assertValidArrayType(UpdateInterface ...$v1MVBlipUpdates): UpdateArrayInterface
    {
        return $this;
    }

    public function getArrayCopy(): UpdateArrayInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): UpdateArrayInterface
    {
        $this->__construct($array);

        return $this;
    }
}
