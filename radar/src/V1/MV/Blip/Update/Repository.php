<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip\Update;

use Neighborhoods\Radar\V1\MV\Blip\UpdateInterface;
use Neighborhoods\Radar\V1;

class Repository implements RepositoryInterface
{
    use V1\MV\Blip\UpdateArray\AwareTrait;
    use V1\MV\Blip\Update\Factory\AwareTrait;

    public function get(int $id): UpdateInterface
    {
        if (!isset($this->getV1MVBlipUpdateArray()[$id])) {

        }

        return $this->getV1MVBlipUpdateArray()[$id];
    }

    public function create(int $id): UpdateInterface
    {
        if (isset($this->getV1MVBlipUpdateArray()[$id])) {
            throw new \LogicException("Update with ID[$id] is already set.");
        } else {
            $this->getV1MVBlipUpdateArray()[$id] = $this->getV1MVBlipUpdateFactory()->create();
        }

        return $this->getV1MVBlipUpdateArray()[$id];
    }

    public function attach(UpdateInterface $update): RepositoryInterface
    {
        $id = $update->getV1MvBlipUpdateId();
        if (isset($this->getV1MVBlipUpdateArray()[$id])) {
            throw new \LogicException("Update with ID[$id] is already set.");
        } else {
            $this->getV1MVBlipUpdateArray()[$id] = $update;
        }

        return $this;
    }

    public function detach(int $id): RepositoryInterface
    {

    }

    public function save(UpdateInterface $update): RepositoryInterface
    {

    }
}