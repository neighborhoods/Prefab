<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\BuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\BuilderActorInterface;

trait AwareTrait
{
    protected $BuilderActor;

    public function setBuilderActor(BuilderActorInterface $BuilderActor): self
    {
        if ($this->hasBuilderActor()) {
            throw new \LogicException('BuilderActor is already set.');
        }
        $this->BuilderActor = $BuilderActor;

        return $this;
    }

    protected function getBuilderActor(): BuilderActorInterface
    {
        if (!$this->hasBuilderActor()) {
            throw new \LogicException('BuilderActor is not set.');
        }

        return $this->BuilderActor;
    }

    protected function hasBuilderActor(): bool
    {
        return isset($this->BuilderActor);
    }

    protected function unsetBuilderActor(): self
    {
        if (!$this->hasBuilderActor()) {
            throw new \LogicException('BuilderActor is not set.');
        }
        unset($this->BuilderActor);

        return $this;
    }
}
