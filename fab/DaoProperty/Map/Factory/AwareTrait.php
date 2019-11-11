<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Map\Factory;

use Neighborhoods\Prefab\DaoProperty\Map\FactoryInterface;

trait AwareTrait
{
    protected $DaoPropertyMapFactory;

    public function setDaoPropertyMapFactory(FactoryInterface $DaoPropertyMapFactory): self
    {
        if ($this->hasDaoPropertyMapFactory()) {
            throw new \LogicException('DaoPropertyMapFactory is already set.');
        }
        $this->DaoPropertyMapFactory = $DaoPropertyMapFactory;

        return $this;
    }

    protected function getDaoPropertyMapFactory(): FactoryInterface
    {
        if (!$this->hasDaoPropertyMapFactory()) {
            throw new \LogicException('DaoPropertyMapFactory is not set.');
        }

        return $this->DaoPropertyMapFactory;
    }

    protected function hasDaoPropertyMapFactory(): bool
    {
        return isset($this->DaoPropertyMapFactory);
    }

    protected function unsetDaoPropertyMapFactory(): self
    {
        if (!$this->hasDaoPropertyMapFactory()) {
            throw new \LogicException('DaoPropertyMapFactory is not set.');
        }
        unset($this->DaoPropertyMapFactory);

        return $this;
    }
}
