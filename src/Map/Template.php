<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Map;

class Template
{
    /** @param RPL_ENTITY_NAMEInterface ...$RPL_ENTITY_ITEMs */
    public function __construct(array $RPL_ENTITY_ITEMs = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($RPL_ENTITY_ITEMs)) {
            $this->assertValidArrayType(...array_values($RPL_ENTITY_ITEMs));
        }

        parent::__construct($RPL_ENTITY_ITEMs, $flags);
    }

    public function offsetGet($index): RPL_ENTITY_NAMEInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param RPL_ENTITY_NAMEInterface $RPL_ENTITY_ITEM */
    public function offsetSet($index, $RPL_ENTITY_ITEM)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($RPL_ENTITY_ITEM));
    }

    /** @param RPL_ENTITY_NAMEInterface $RPL_ENTITY_ITEM */
    public function append($RPL_ENTITY_ITEM)
    {
        $this->assertValidArrayItemType($RPL_ENTITY_ITEM);
        parent::append($RPL_ENTITY_ITEM);
    }

    public function current(): RPL_ENTITY_NAMEInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(RPL_ENTITY_NAMEInterface $RPL_ENTITY_ITEM)
    {
        return $RPL_ENTITY_ITEM;
    }

    protected function assertValidArrayType(RPL_ENTITY_NAMEInterface ...$RPL_ENTITY_ITEMs): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
