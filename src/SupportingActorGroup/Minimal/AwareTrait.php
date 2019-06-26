<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Minimal;

use Neighborhoods\Prefab\SupportingActorGroup\MinimalInterface;

trait AwareTrait
{
    protected $Minimal;

    public function setMinimal(MinimalInterface $Minimal): self
    {
        if ($this->hasMinimal()) {
            throw new \LogicException('Minimal is already set.');
        }
        $this->Minimal = $Minimal;

        return $this;
    }

    protected function getMinimal(): MinimalInterface
    {
        if (!$this->hasMinimal()) {
            throw new \LogicException('Minimal is not set.');
        }

        return $this->Minimal;
    }

    protected function hasMinimal(): bool
    {
        return isset($this->Minimal);
    }

    protected function unsetMinimal(): self
    {
        if (!$this->hasMinimal()) {
            throw new \LogicException('Minimal is not set.');
        }
        unset($this->Minimal);

        return $this;
    }
}
