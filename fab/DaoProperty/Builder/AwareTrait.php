<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Builder;

use Neighborhoods\Prefab\DaoProperty\BuilderInterface;

trait AwareTrait
{
    protected $DaoPropertyBuilder;

    public function setDaoPropertyBuilder(BuilderInterface $DaoPropertyBuilder): self
    {
        if ($this->hasDaoPropertyBuilder()) {
            throw new \LogicException('DaoPropertyBuilder is already set.');
        }
        $this->DaoPropertyBuilder = $DaoPropertyBuilder;

        return $this;
    }

    protected function getDaoPropertyBuilder(): BuilderInterface
    {
        if (!$this->hasDaoPropertyBuilder()) {
            throw new \LogicException('DaoPropertyBuilder is not set.');
        }

        return $this->DaoPropertyBuilder;
    }

    protected function hasDaoPropertyBuilder(): bool
    {
        return isset($this->DaoPropertyBuilder);
    }

    protected function unsetDaoPropertyBuilder(): self
    {
        if (!$this->hasDaoPropertyBuilder()) {
            throw new \LogicException('DaoPropertyBuilder is not set.');
        }
        unset($this->DaoPropertyBuilder);

        return $this;
    }
}
