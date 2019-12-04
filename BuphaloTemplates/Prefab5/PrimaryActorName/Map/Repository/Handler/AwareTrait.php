<?php

namespace Neighborhoods\BuphaloTemplateTree\Template\Actor\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $PrimaryActorNameMapRepositoryHandler = null;

    public function setPrimaryActorNameMapRepositoryHandler(\Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository\HandlerInterface $PrimaryActorNameMapRepositoryHandler) : self
    {
        if ($this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is already set.');
        }
        $this->PrimaryActorNameMapRepositoryHandler = $PrimaryActorNameMapRepositoryHandler;

        return $this;
    }

    protected function getPrimaryActorNameMapRepositoryHandler() : \Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository\HandlerInterface
    {
        if (!$this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is not set.');
        }

        return $this->PrimaryActorNameMapRepositoryHandler;
    }

    protected function hasActorMapRepositoryHandler() : bool
    {
        return isset($this->PrimaryActorNameMapRepositoryHandler);
    }

    protected function unsetPrimaryActorNameMapRepositoryHandler() : self
    {
        if (!$this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is not set.');
        }
        unset($this->PrimaryActorNameMapRepositoryHandler);

        return $this;
    }


}

