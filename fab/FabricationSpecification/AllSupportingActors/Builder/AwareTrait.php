<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationAllSupportingActorsBuilder;

    public function setFabricationSpecificationAllSupportingActorsBuilder(BuilderInterface $AllSupportingActorsBuilder): self
    {
        if ($this->hasFabricationSpecificationAllSupportingActorsBuilder()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilder is already set.');
        }
        $this->FabricationSpecificationAllSupportingActorsBuilder = $AllSupportingActorsBuilder;

        return $this;
    }

    protected function getFabricationSpecificationAllSupportingActorsBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsBuilder()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilder is not set.');
        }

        return $this->FabricationSpecificationAllSupportingActorsBuilder;
    }

    protected function hasFabricationSpecificationAllSupportingActorsBuilder(): bool
    {
        return isset($this->FabricationSpecificationAllSupportingActorsBuilder);
    }

    protected function unsetFabricationSpecificationAllSupportingActorsBuilder(): self
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsBuilder()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilder is not set.');
        }
        unset($this->FabricationSpecificationAllSupportingActorsBuilder);

        return $this;
    }
}
