<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param ConstantInterface ...$Constants */
    public function __construct(array $Constants = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($Constants)) {
            $this->assertValidArrayType(...array_values($Constants));
        }

        parent::__construct($Constants, $flags);
    }

    public function offsetGet($index): ConstantInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ConstantInterface $Constant */
    public function offsetSet($index, $Constant)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Constant));
    }

    /** @param ConstantInterface $Constant */
    public function append($Constant)
    {
        $this->assertValidArrayItemType($Constant);
        parent::append($Constant);
    }

    public function current(): ConstantInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ConstantInterface $Constant)
    {
        return $Constant;
    }

    protected function assertValidArrayType(ConstantInterface ...$Constants): MapInterface
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

    /** @param ConstantInterface ...$Constants */
    public function hydrate(array $Constants): MapInterface
    {
        $this->__construct($Constants);

        return $this;
    }
}
