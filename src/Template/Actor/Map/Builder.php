<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    protected $records;

    public function build(): MapInterface
    {
        $map = $this->getActorMapFactory()->create();

        // @TODO - build the object.
        throw new \LogicException('Unimplemented build method.');

        return $map;
    }

    protected function getRecords(): array
    {
        if ($this->records === null) {
            throw new \LogicException('Builder records has not been set.');
        }

        return $this->records;
    }

    public function setRecords(array $records): BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}
