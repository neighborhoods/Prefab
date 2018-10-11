<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param DecoratorInterface ...$decorators */
    public function __construct(array $decorators = array(), int $flags = 0);

    public function offsetGet($index): DecoratorInterface;

    /** @param DecoratorInterface $decorator */
    public function offsetSet($index, $decorator);

    /** @param DecoratorInterface $decorator */
    public function append($decorator);

    public function current(): DecoratorInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
