<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder\Factory;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder\FactoryInterface;

trait AwareTrait
{
    protected $PrimaryActorNameMapBuilderFactory;

    public function setPrimaryActorNameMapBuilderFactory(FactoryInterface $PrimaryActorNameMapBuilderFactory): self
    {
        if ($this->hasPrimaryActorNameMapBuilderFactory()) {
            throw new \LogicException('PrimaryActorNameMapBuilderFactory is already set.');
        }
        $this->PrimaryActorNameMapBuilderFactory = $PrimaryActorNameMapBuilderFactory;

        return $this;
    }

    protected function getPrimaryActorNameMapBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPrimaryActorNameMapBuilderFactory()) {
            throw new \LogicException('PrimaryActorNameMapBuilderFactory is not set.');
        }

        return $this->PrimaryActorNameMapBuilderFactory;
    }

    protected function hasPrimaryActorNameMapBuilderFactory(): bool
    {
        return isset($this->PrimaryActorNameMapBuilderFactory);
    }

    protected function unsetPrimaryActorNameMapBuilderFactory(): self
    {
        if (!$this->hasPrimaryActorNameMapBuilderFactory()) {
            throw new \LogicException('PrimaryActorNameMapBuilderFactory is not set.');
        }
        unset($this->PrimaryActorNameMapBuilderFactory);

        return $this;
    }
}
