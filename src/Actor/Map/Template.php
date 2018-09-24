<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

class Template
{
    /** @param REPLACE_DAO_NAMEInterface ...$REPLACE_DAO_VARs */
    public function __construct(array $REPLACE_DAO_VARs = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($REPLACE_DAO_VARs)) {
            $this->assertValidArrayType(...array_values($REPLACE_DAO_VARs));
        }

        parent::__construct($REPLACE_DAO_VARs, $flags);
    }

    public function offsetGet($index): REPLACE_DAO_NAMEInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param REPLACE_DAO_NAMEInterface $REPLACE_DAO_VAR */
    public function offsetSet($index, $REPLACE_DAO_VAR)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($REPLACE_DAO_VAR));
    }

    /** @param REPLACE_DAO_NAMEInterface $REPLACE_DAO_VAR */
    public function append($REPLACE_DAO_VAR)
    {
        $this->assertValidArrayItemType($REPLACE_DAO_VAR);
        parent::append($REPLACE_DAO_VAR);
    }

    public function current(): REPLACE_DAO_NAMEInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(REPLACE_DAO_NAMEInterface $REPLACE_DAO_VAR)
    {
        return $REPLACE_DAO_VAR;
    }

    protected function assertValidArrayType(REPLACE_DAO_NAMEInterface ...$REPLACE_DAO_VARs): MapInterface
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
