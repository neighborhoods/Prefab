<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecificationRepository;

    public function setFabricationSpecificationRepository(FabricationSpecificationInterface $Repository): self
    {
        if ($this->hasFabricationSpecificationAllRepository()) {
            throw new \LogicException('FabricationSpecificationRepository is already set.');
        }
        $this->FabricationSpecificationRepository = $Repository;

        return $this;
    }

    protected function getFabricationSpecificationRepository(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecificationAllRepository()) {
            throw new \LogicException('FabricationSpecificationRepository is not set.');
        }

        return $this->FabricationSpecificationRepository;
    }

    protected function hasFabricationSpecificationAllRepository(): bool
    {
        return isset($this->FabricationSpecificationRepository);
    }

    protected function unsetFabricationSpecificationRepository(): self
    {
        if (!$this->hasFabricationSpecificationAllRepository()) {
            throw new \LogicException('FabricationSpecificationRepository is not set.');
        }
        unset($this->FabricationSpecificationRepository);

        return $this;
    }
}
