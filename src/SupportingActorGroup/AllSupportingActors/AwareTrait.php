<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActors;

use Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActorsInterface;

trait AwareTrait
{
    protected $AllSupportingActors;

    public function setAllSupportingActors(AllSupportingActorsInterface $AllSupportingActors): self
    {
        if ($this->hasAllSupportingActors()) {
            throw new \LogicException('AllSupportingActors is already set.');
        }
        $this->AllSupportingActors = $AllSupportingActors;

        return $this;
    }

    protected function getAllSupportingActors(): AllSupportingActorsInterface
    {
        if (!$this->hasAllSupportingActors()) {
            throw new \LogicException('AllSupportingActors is not set.');
        }

        return $this->AllSupportingActors;
    }

    protected function hasAllSupportingActors(): bool
    {
        return isset($this->AllSupportingActors);
    }

    protected function unsetAllSupportingActors(): self
    {
        if (!$this->hasAllSupportingActors()) {
            throw new \LogicException('AllSupportingActors is not set.');
        }
        unset($this->AllSupportingActors);

        return $this;
    }
}
