<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Factory;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\FactoryInterface;

trait AwareTrait
{
    protected $PrimaryActorNameFactory;

    public function setPrimaryActorNameFactory(FactoryInterface $PrimaryActorNameFactory): self
    {
        if ($this->hasPrimaryActorNameFactory()) {
            throw new \LogicException('PrimaryActorNameFactory is already set.');
        }
        $this->PrimaryActorNameFactory = $PrimaryActorNameFactory;

        return $this;
    }

    protected function getPrimaryActorNameFactory(): FactoryInterface
    {
        if (!$this->hasPrimaryActorNameFactory()) {
            throw new \LogicException('PrimaryActorNameFactory is not set.');
        }

        return $this->PrimaryActorNameFactory;
    }

    protected function hasPrimaryActorNameFactory(): bool
    {
        return isset($this->PrimaryActorNameFactory);
    }

    protected function unsetPrimaryActorNameFactory(): self
    {
        if (!$this->hasPrimaryActorNameFactory()) {
            throw new \LogicException('PrimaryActorNameFactory is not set.');
        }
        unset($this->PrimaryActorNameFactory);

        return $this;
    }
}
