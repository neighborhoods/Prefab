<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor;

use Neighborhoods\BuphaloTemplateTree\ActorInterface;

trait AwareTrait
{
    protected $Actor;

    public function setActor(ActorInterface $Actor): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->Actor = $Actor;

        return $this;
    }

    protected function getActor(): ActorInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->Actor;
    }

    protected function hasActor(): bool
    {
        return isset($this->Actor);
    }

    protected function unsetActor(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->Actor);

        return $this;
    }
}
