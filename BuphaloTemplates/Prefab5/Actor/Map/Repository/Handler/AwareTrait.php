<?php

namespace Neighborhoods\BuphaloTemplateTree\Template\Actor\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $ActorMapRepositoryHandler = null;

    public function setActorMapRepositoryHandler(\Neighborhoods\BuphaloTemplateTree\Actor\Map\Repository\HandlerInterface $ActorMapRepositoryHandler) : self
    {
        if ($this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is already set.');
        }
        $this->ActorMapRepositoryHandler = $ActorMapRepositoryHandler;

        return $this;
    }

    protected function getActorMapRepositoryHandler() : \Neighborhoods\BuphaloTemplateTree\Actor\Map\Repository\HandlerInterface
    {
        if (!$this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is not set.');
        }

        return $this->ActorMapRepositoryHandler;
    }

    protected function hasActorMapRepositoryHandler() : bool
    {
        return isset($this->ActorMapRepositoryHandler);
    }

    protected function unsetActorMapRepositoryHandler() : self
    {
        if (!$this->hasActorMapRepositoryHandler()) {
            throw new \LogicException('ActorMapRepositoryHandler is not set.');
        }
        unset($this->ActorMapRepositoryHandler);

        return $this;
    }


}

