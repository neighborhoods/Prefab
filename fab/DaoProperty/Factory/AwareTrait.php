<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Factory;

use Neighborhoods\Prefab\DaoProperty\FactoryInterface;

trait AwareTrait
{
    protected $DaoPropertyFactory;

    public function setDaoPropertyFactory(FactoryInterface $DaoPropertyFactory): self
    {
        if ($this->hasDaoPropertyFactory()) {
            throw new \LogicException('DaoPropertyFactory is already set.');
        }
        $this->DaoPropertyFactory = $DaoPropertyFactory;

        return $this;
    }

    protected function getDaoPropertyFactory(): FactoryInterface
    {
        if (!$this->hasDaoPropertyFactory()) {
            throw new \LogicException('DaoPropertyFactory is not set.');
        }

        return $this->DaoPropertyFactory;
    }

    protected function hasDaoPropertyFactory(): bool
    {
        return isset($this->DaoPropertyFactory);
    }

    protected function unsetDaoPropertyFactory(): self
    {
        if (!$this->hasDaoPropertyFactory()) {
            throw new \LogicException('DaoPropertyFactory is not set.');
        }
        unset($this->DaoPropertyFactory);

        return $this;
    }
}
