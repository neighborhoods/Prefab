<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Builder\Factory;

use Neighborhoods\Prefab\DaoProperty\Builder\FactoryInterface;

trait AwareTrait
{
    protected $DaoPropertyBuilderFactory;

    public function setDaoPropertyBuilderFactory(FactoryInterface $DaoPropertyBuilderFactory): self
    {
        if ($this->hasDaoPropertyBuilderFactory()) {
            throw new \LogicException('DaoPropertyBuilderFactory is already set.');
        }
        $this->DaoPropertyBuilderFactory = $DaoPropertyBuilderFactory;

        return $this;
    }

    protected function getDaoPropertyBuilderFactory(): FactoryInterface
    {
        if (!$this->hasDaoPropertyBuilderFactory()) {
            throw new \LogicException('DaoPropertyBuilderFactory is not set.');
        }

        return $this->DaoPropertyBuilderFactory;
    }

    protected function hasDaoPropertyBuilderFactory(): bool
    {
        return isset($this->DaoPropertyBuilderFactory);
    }

    protected function unsetDaoPropertyBuilderFactory(): self
    {
        if (!$this->hasDaoPropertyBuilderFactory()) {
            throw new \LogicException('DaoPropertyBuilderFactory is not set.');
        }
        unset($this->DaoPropertyBuilderFactory);

        return $this;
    }
}
