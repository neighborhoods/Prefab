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
        if ($this->hasPrimaryActorNameMapRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameMapRepositoryHandler is already set.');
        }
        $this->PrimaryActorNameMapRepositoryHandler = $PrimaryActorNameMapRepositoryHandler;

        return $this;
    }

    protected function getPrimaryActorNameMapRepositoryHandler() : \Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository\HandlerInterface
    {
        if (!$this->hasPrimaryActorNameMapRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameMapRepositoryHandler is not set.');
        }

        return $this->PrimaryActorNameMapRepositoryHandler;
    }

    protected function hasPrimaryActorNameMapRepositoryHandler() : bool
    {
        return isset($this->PrimaryActorNameMapRepositoryHandler);
    }

    protected function unsetPrimaryActorNameMapRepositoryHandler() : self
    {
        if (!$this->hasPrimaryActorNameMapRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameMapRepositoryHandler is not set.');
        }
        unset($this->PrimaryActorNameMapRepositoryHandler);

        return $this;
    }


}
