<?php

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Bradfab\Template\Actor\Map\Factory\AwareTrait;
    use \Neighborhoods\Bradfab\Template\Actor\Builder\Factory\AwareTrait;

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
            /** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder-identity-field
            $map[]
        */ = $item;
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

