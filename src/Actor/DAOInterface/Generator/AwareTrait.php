<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAOInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorDAOInterfaceGenerator;

    public function setActorDAOInterfaceGenerator(GeneratorInterface $actorDAOInterfaceGenerator) : self
    {
        if ($this->hasActorDAOInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorDAOInterfaceGenerator = $actorDAOInterfaceGenerator;

        return $this;
    }

    protected function getActorDAOInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasActorDAOInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorDAOInterfaceGenerator;
    }

    protected function hasActorDAOInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabActorDAOInterfaceGenerator);
    }

    protected function unsetActorDAOInterfaceGenerator() : self
    {
        if (!$this->hasActorDAOInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorDAOInterfaceGenerator);

        return $this;
    }
}
