<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

trait AwareTrait
{
    protected $DaoProperty;

    public function setDaoProperty(DaoPropertyInterface $DaoProperty): self
    {
        if ($this->hasDaoProperty()) {
            throw new \LogicException('DaoProperty is already set.');
        }
        $this->DaoProperty = $DaoProperty;

        return $this;
    }

    protected function getDaoProperty(): DaoPropertyInterface
    {
        if (!$this->hasDaoProperty()) {
            throw new \LogicException('DaoProperty is not set.');
        }

        return $this->DaoProperty;
    }

    protected function hasDaoProperty(): bool
    {
        return isset($this->DaoProperty);
    }

    protected function unsetDaoProperty(): self
    {
        if (!$this->hasDaoProperty()) {
            throw new \LogicException('DaoProperty is not set.');
        }
        unset($this->DaoProperty);

        return $this;
    }
}
