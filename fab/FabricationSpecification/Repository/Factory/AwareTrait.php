<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Repository\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationRepositoryFactory;

    public function setFabricationSpecificationRepositoryFactory(FactoryInterface $RepositoryFactory): self
    {
        if ($this->hasFabricationSpecificationRepositoryFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryFactory is already set.');
        }
        $this->FabricationSpecificationRepositoryFactory = $RepositoryFactory;

        return $this;
    }

    protected function getFabricationSpecificationRepositoryFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationRepositoryFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryFactory is not set.');
        }

        return $this->FabricationSpecificationRepositoryFactory;
    }

    protected function hasFabricationSpecificationRepositoryFactory(): bool
    {
        return isset($this->FabricationSpecificationRepositoryFactory);
    }

    protected function unsetFabricationSpecificationRepositoryFactory(): self
    {
        if (!$this->hasFabricationSpecificationRepositoryFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryFactory is not set.');
        }
        unset($this->FabricationSpecificationRepositoryFactory);

        return $this;
    }
}
