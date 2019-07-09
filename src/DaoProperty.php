<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;


class DaoProperty implements DaoPropertyInterface
{
    protected $name;
    protected $data_type;
    protected $nullable;
    protected $record_key;

    public function getName() : string
    {
        if ($this->name === null) {
            throw new \LogicException('DaoProperty name has not been set.');
        }
        return $this->name;
    }

    public function setName(string $name) : DaoPropertyInterface
    {
        if ($this->name !== null) {
            throw new \LogicException('DaoProperty name is already set.');
        }
        $this->name = $name;
        return $this;
    }

    public function getDataType() : string
    {
        if ($this->data_type === null) {
            throw new \LogicException('DaoProperty dataType has not been set.');
        }
        return $this->data_type;
    }

    public function setDataType(string $data_type) : DaoPropertyInterface
    {
        if ($this->data_type !== null) {
            throw new \LogicException('DaoProperty dataType is already set.');
        }
        $this->data_type = $data_type;
        return $this;
    }

    public function isNullable() : bool
    {
        if ($this->nullable === null) {
            throw new \LogicException('DaoProperty nullable has not been set.');
        }
        return $this->nullable;
    }

    public function setNullable(bool $nullable) : DaoPropertyInterface
    {
        if ($this->nullable !== null) {
            throw new \LogicException('DaoProperty nullable is already set.');
        }
        $this->nullable = $nullable;
        return $this;
    }

    public function getRecordKey() : string
    {
        if ($this->record_key === null) {
            throw new \LogicException('DaoProperty record_key has not been set.');
        }
        return $this->record_key;
    }

    public function setRecordKey(string $record_key) : DaoPropertyInterface
    {
        if ($this->record_key !== null) {
            throw new \LogicException('DaoProperty record_key is already set.');
        }
        $this->record_key = $record_key;
        return $this;
    }
}
