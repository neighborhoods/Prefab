<?php
declare(strict_types=1);
namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

class Builder implements BuilderInterface
{

    use PrimaryActorName\Map\Factory\AwareTrait;
    use PrimaryActorName\Builder\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $records = null;

    public function build() : MapInterface
    {
        $map = $this->getPrimaryActorNameMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getPrimaryActorNameBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            /** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder-identity-field
            $map[]
        */ = $item;
        }

        return $map;
    }

    public function buildForInsert() : MapInterface
    {
        $map = $this->getPrimaryActorNameMapFactory()->create();
        foreach ($this->getRecords() as $index => $record) {
            $builder = $this->getPrimaryActorNameBuilderFactory()->create();
            $item = $builder->setRecord($record)->buildForInsert();
            $itemIndex = /** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder-identity-field-ternary
            $index
             */;
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

