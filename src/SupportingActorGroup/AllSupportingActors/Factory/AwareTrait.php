<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActors\Factory;

use Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActors\FactoryInterface;

trait AwareTrait
{
    protected $AllSupportingActorsFactory;

    public function setAllSupportingActorsFactory(FactoryInterface $AllSupportingActorsFactory): self
    {
        if ($this->hasAllSupportingActorsFactory()) {
            throw new \LogicException('AllSupportingActorsFactory is already set.');
        }
        $this->AllSupportingActorsFactory = $AllSupportingActorsFactory;

        return $this;
    }

    protected function getAllSupportingActorsFactory(): FactoryInterface
    {
        if (!$this->hasAllSupportingActorsFactory()) {
            throw new \LogicException('AllSupportingActorsFactory is not set.');
        }

        return $this->AllSupportingActorsFactory;
    }

    protected function hasAllSupportingActorsFactory(): bool
    {
        return isset($this->AllSupportingActorsFactory);
    }

    protected function unsetAllSupportingActorsFactory(): self
    {
        if (!$this->hasAllSupportingActorsFactory()) {
            throw new \LogicException('AllSupportingActorsFactory is not set.');
        }
        unset($this->AllSupportingActorsFactory);

        return $this;
    }
}
