<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\BuilderActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\BuilderActor\FactoryInterface;

trait AwareTrait
{
    protected $BuilderActorFactory;

    public function setBuilderActorFactory(FactoryInterface $BuilderActorFactory): self
    {
        if ($this->hasBuilderActorFactory()) {
            throw new \LogicException('BuilderActorFactory is already set.');
        }
        $this->BuilderActorFactory = $BuilderActorFactory;

        return $this;
    }

    protected function getBuilderActorFactory(): FactoryInterface
    {
        if (!$this->hasBuilderActorFactory()) {
            throw new \LogicException('BuilderActorFactory is not set.');
        }

        return $this->BuilderActorFactory;
    }

    protected function hasBuilderActorFactory(): bool
    {
        return isset($this->BuilderActorFactory);
    }

    protected function unsetBuilderActorFactory(): self
    {
        if (!$this->hasBuilderActorFactory()) {
            throw new \LogicException('BuilderActorFactory is not set.');
        }
        unset($this->BuilderActorFactory);

        return $this;
    }
}
