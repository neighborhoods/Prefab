<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Repository\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationRepositoryBuilder;

    public function setFabricationSpecificationRepositoryBuilder(BuilderInterface $RepositoryBuilder): self
    {
        if ($this->hasFabricationSpecificationRepositoryBuilder()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilder is already set.');
        }
        $this->FabricationSpecificationRepositoryBuilder = $RepositoryBuilder;

        return $this;
    }

    protected function getFabricationSpecificationRepositoryBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationRepositoryBuilder()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilder is not set.');
        }

        return $this->FabricationSpecificationRepositoryBuilder;
    }

    protected function hasFabricationSpecificationRepositoryBuilder(): bool
    {
        return isset($this->FabricationSpecificationRepositoryBuilder);
    }

    protected function unsetFabricationSpecificationRepositoryBuilder(): self
    {
        if (!$this->hasFabricationSpecificationRepositoryBuilder()) {
            throw new \LogicException('FabricationSpecificationRepositoryBuilder is not set.');
        }
        unset($this->FabricationSpecificationRepositoryBuilder);

        return $this;
    }
}
