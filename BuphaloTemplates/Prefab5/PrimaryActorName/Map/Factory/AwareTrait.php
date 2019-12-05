<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Factory;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\FactoryInterface;

trait AwareTrait
{
    protected $PrimaryActorNameMapFactory;

    public function setPrimaryActorNameMapFactory(FactoryInterface $PrimaryActorNameMapFactory): self
    {
        if ($this->hasPrimaryActorNameMapFactory()) {
            throw new \LogicException('PrimaryActorNameMapFactory is already set.');
        }
        $this->PrimaryActorNameMapFactory = $PrimaryActorNameMapFactory;

        return $this;
    }

    protected function getPrimaryActorNameMapFactory(): FactoryInterface
    {
        if (!$this->hasPrimaryActorNameMapFactory()) {
            throw new \LogicException('PrimaryActorNameMapFactory is not set.');
        }

        return $this->PrimaryActorNameMapFactory;
    }

    protected function hasPrimaryActorNameMapFactory(): bool
    {
        return isset($this->PrimaryActorNameMapFactory);
    }

    protected function unsetPrimaryActorNameMapFactory(): self
    {
        if (!$this->hasPrimaryActorNameMapFactory()) {
            throw new \LogicException('PrimaryActorNameMapFactory is not set.');
        }
        unset($this->PrimaryActorNameMapFactory);

        return $this;
    }
}
