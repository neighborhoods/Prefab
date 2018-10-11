<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAO\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorDAOGenerator;

    public function setActorDAOGenerator(GeneratorInterface $actorDAOGenerator) : self
    {
        if ($this->hasActorDAOGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorDAOGenerator = $actorDAOGenerator;

        return $this;
    }

    protected function getActorDAOGenerator() : GeneratorInterface
    {
        if (!$this->hasActorDAOGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorDAOGenerator;
    }

    protected function hasActorDAOGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabActorDAOGenerator);
    }

    protected function unsetActorDAOGenerator() : self
    {
        if (!$this->hasActorDAOGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorDAOGenerator);

        return $this;
    }
}
