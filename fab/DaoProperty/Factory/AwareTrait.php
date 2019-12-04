<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Factory;

use Neighborhoods\Prefab\DaoProperty\FactoryInterface;

trait AwareTrait
{
    protected $DaoPropertyFactory;

    public function setDaoPropertyFactory(FactoryInterface $DaoPropertyFactory): self
    {
        if ($this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->DaoPropertyFactory = $DaoPropertyFactory;

        return $this;
    }

    protected function getDaoPropertyFactory(): FactoryInterface
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->DaoPropertyFactory;
    }

    protected function hasActorFactory(): bool
    {
        return isset($this->DaoPropertyFactory);
    }

    protected function unsetDaoPropertyFactory(): self
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->DaoPropertyFactory);

        return $this;
    }
}
