<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-AwareTraits
 */
    protected $record;

    public function build(): PrimaryActorNameInterface
    {
        $Actor = $this->getActorFactory()->create();

        $record = $this->getRecord();

/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-build
 */

        return $Actor;
    }

    public function buildForInsert(): PrimaryActorNameInterface
    {
        $Actor = $this->getActorFactory()->create();

        $record = $this->getRecord();

/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-buildForInsert
 */

        return $Actor;
    }

    protected function getRecord(): array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record): BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
