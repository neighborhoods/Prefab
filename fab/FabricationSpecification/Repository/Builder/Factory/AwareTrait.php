<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Repository\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationRepositoryBuilderFactory;

    public function setFabricationSpecificationRepositoryBuilderFactory(FactoryInterface $RepositoryBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationRepositoryBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilderFactory is already set.');
        }
        $this->FabricationSpecificationRepositoryBuilderFactory = $RepositoryBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationRepositoryBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationRepositoryBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationRepositoryBuilderFactory;
    }

    protected function hasFabricationSpecificationRepositoryBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationRepositoryBuilderFactory);
    }

    protected function unsetFabricationSpecificationRepositoryBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationRepositoryBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationRepositoryBuilderFactory);

        return $this;
    }
}
