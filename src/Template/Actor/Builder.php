<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    protected $record;

    public function build(): ActorInterface
    {
        $Actor = $this->getActorFactory()->create();
        /** @neighborhoods-bradfab:annotation-processor Neighborhoods\Bradfab\Template\Actor\Builder.build1
         */
        /** @neighborhoods-bradfab:annotation-processor Neighborhoods\Bradfab\Template\Actor\Builder.build2
        // @TODO - build the object.
        throw new \LogicException('Unimplemented build method.');
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
