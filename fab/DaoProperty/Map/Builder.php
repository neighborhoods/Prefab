<?php
declare(strict_types=1);
namespace Neighborhoods\Prefab\DaoProperty\Map;

use Neighborhoods\Prefab\DaoProperty\MapInterface;
use Neighborhoods\Prefab\DaoProperty;

class Builder implements BuilderInterface
{

    use Actor\Map\Factory\AwareTrait;
    use Actor\Builder\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $records = null;

    public function build() : MapInterface
    {
        $map = $this->getActorMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getActorBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            
            $map[] = $item;
        }

        return $map;
    }

    public function buildForInsert() : MapInterface
    {
        $map = $this->getActorMapFactory()->create();
        foreach ($this->getRecords() as $index => $record) {
            $builder = $this->getActorBuilderFactory()->create();
            $item = $builder->setRecord($record)->buildForInsert();
            $itemIndex = 
            $index;
            $map[$itemIndex] = $item;
        }

        return $map;
    }

    protected function getRecords() : array
    {
        if ($this->records === null) {
            throw new \LogicException('Builder records has not been set.');
        }

        return $this->records;
    }

    public function setRecords(array $records) : BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}

