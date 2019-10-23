<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Map\Builder;

use Neighborhoods\Prefab\DaoProperty\Map\BuilderInterface;

trait AwareTrait
{
    protected $DaoPropertyMapBuilder;

    public function setDaoPropertyMapBuilder(BuilderInterface $DaoPropertyMapBuilder): self
    {
        if ($this->hasDaoPropertyMapBuilder()) {
            throw new \LogicException('DaoPropertyMapBuilder is already set.');
        }
        $this->DaoPropertyMapBuilder = $DaoPropertyMapBuilder;

        return $this;
    }

    protected function getDaoPropertyMapBuilder(): BuilderInterface
    {
        if (!$this->hasDaoPropertyMapBuilder()) {
            throw new \LogicException('DaoPropertyMapBuilder is not set.');
        }

        return $this->DaoPropertyMapBuilder;
    }

    protected function hasDaoPropertyMapBuilder(): bool
    {
        return isset($this->DaoPropertyMapBuilder);
    }

    protected function unsetDaoPropertyMapBuilder(): self
    {
        if (!$this->hasDaoPropertyMapBuilder()) {
            throw new \LogicException('DaoPropertyMapBuilder is not set.');
        }
        unset($this->DaoPropertyMapBuilder);

        return $this;
    }
}
