<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param DecoratorInterface ...$decorators */
    public function __construct(array $decorators = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($decorators)) {
            $this->assertValidArrayType(...array_values($decorators));
        }

        parent::__construct($decorators, $flags);
    }

    public function offsetGet($index): DecoratorInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param DecoratorInterface $decorator */
    public function offsetSet($index, $decorator)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($decorator));
    }

    /** @param DecoratorInterface $decorator */
    public function append($decorator)
    {
        $this->assertValidArrayItemType($decorator);
        parent::append($decorator);
    }

    public function current(): DecoratorInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(DecoratorInterface $decorator)
    {
        return $decorator;
    }

    protected function assertValidArrayType(DecoratorInterface ...$decorators): MapInterface
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
