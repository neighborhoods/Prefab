<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param ActorInterface ...$Actors */
    public function __construct(array $Actors = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($Actors)) {
            $this->assertValidArrayType(...array_values($Actors));
        }

        parent::__construct($Actors, $flags);
    }

    public function offsetGet($index): ActorInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ActorInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param ActorInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): ActorInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ActorInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(ActorInterface ...$Actors): MapInterface
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

    /** @param ActorInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}
