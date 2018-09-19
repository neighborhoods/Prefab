<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\VisitorInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param VisitorInterface ...$visitors */
    public function __construct(array $visitors = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($visitors)) {
            $this->assertValidArrayType(...array_values($visitors));
        }

        parent::__construct($visitors, $flags);
    }

    public function offsetGet($index): VisitorInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param VisitorInterface $visitor */
    public function offsetSet($index, $visitor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($visitor));
    }

    /** @param VisitorInterface $visitor */
    public function append($visitor)
    {
        $this->assertValidArrayItemType($visitor);
        parent::append($visitor);
    }

    public function current(): VisitorInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(VisitorInterface $visitor)
    {
        return $visitor;
    }

    protected function assertValidArrayType(VisitorInterface ...$visitors): MapInterface
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
