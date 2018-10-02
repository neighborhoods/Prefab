<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilder;

class Template
{
    // use Neighborhoods\UserService\MV1\User\Map\Factory\AwareTrait;
    // use Neighborhoods\UserService\MV1\User\Builder\Factory\AwareTrait ;

    /** @var array */
    protected $records;

    public function build() : \NAMESPACEPLACEHOLDERInterface
    {
        $map = $this->getDAOVARNAMEPLACEHOLDERFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getPARENTVARNAMEPLACEHOLDERBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            $map[/*$item->getId()*/] = $item; // remove or change index field as desired
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

    public function setRecords(array $records) : \NAMESPACEPLACEHOLDER\BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}
