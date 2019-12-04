<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Builder;

use Neighborhoods\Prefab\DaoProperty\BuilderInterface;

trait AwareTrait
{
    protected $DaoPropertyBuilder;

    public function setDaoPropertyBuilder(BuilderInterface $DaoPropertyBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->DaoPropertyBuilder = $DaoPropertyBuilder;

        return $this;
    }

    protected function getDaoPropertyBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->DaoPropertyBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->DaoPropertyBuilder);
    }

    protected function unsetDaoPropertyBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->DaoPropertyBuilder);

        return $this;
    }
}
