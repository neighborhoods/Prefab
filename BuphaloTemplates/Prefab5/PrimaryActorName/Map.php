<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param PrimaryActorNameInterface ...$PrimaryActorNames */
    public function __construct(array $PrimaryActorNames = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($PrimaryActorNames)) {
            $this->assertValidArrayType(...array_values($PrimaryActorNames));
        }

        parent::__construct($PrimaryActorNames, $flags);
    }

    public function offsetGet($index): PrimaryActorNameInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param PrimaryActorNameInterface $PrimaryActorName */
    public function offsetSet($index, $PrimaryActorName)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($PrimaryActorName));
    }

    /** @param PrimaryActorNameInterface $PrimaryActorName */
    public function append($PrimaryActorName)
    {
        $this->assertValidArrayItemType($PrimaryActorName);
        parent::append($PrimaryActorName);
    }

    public function current(): PrimaryActorNameInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(PrimaryActorNameInterface $PrimaryActorName)
    {
        return $PrimaryActorName;
    }

    protected function assertValidArrayType(PrimaryActorNameInterface ...$PrimaryActorNames): MapInterface
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

    /** @param PrimaryActorNameInterface ...$PrimaryActorNames */
    public function hydrate(array $PrimaryActorNames): MapInterface
    {
        $this->__construct($PrimaryActorNames);

        return $this;
    }
}
