<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param PrimaryActorNameInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($Actors)) {
            $this->assertValidArrayType(...array_values($Actors));
        }

        parent::__construct($Actors, $flags);
    }

    public function offsetGet($index): PrimaryActorNameInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param PrimaryActorNameInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param PrimaryActorNameInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): PrimaryActorNameInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(PrimaryActorNameInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(PrimaryActorNameInterface ...$Actors): MapInterface
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

    /** @param PrimaryActorNameInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}
