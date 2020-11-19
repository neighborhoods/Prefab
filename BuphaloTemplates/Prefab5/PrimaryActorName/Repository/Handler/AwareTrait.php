<?php

namespace Neighborhoods\BuphaloTemplateTree\Template\Actor\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{
    protected $PrimaryActorNameRepositoryHandler = null;

    public function setPrimaryActorNameRepositoryHandler(\Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Repository\HandlerInterface $PrimaryActorNameRepositoryHandler) : self
    {
        if ($this->hasPrimaryActorNameRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameRepositoryHandler is already set.');
        }
        $this->PrimaryActorNameRepositoryHandler = $PrimaryActorNameRepositoryHandler;

        return $this;
    }

    protected function getPrimaryActorNameRepositoryHandler() : \Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Repository\HandlerInterface
    {
        if (!$this->hasPrimaryActorNameRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameMapRepositoryHandler is not set.');
        }

        return $this->PrimaryActorNameRepositoryHandler;
    }

    protected function hasPrimaryActorNameRepositoryHandler() : bool
    {
        return isset($this->PrimaryActorNameRepositoryHandler);
    }

    protected function unsetPrimaryActorNameRepositoryHandler() : self
    {
        if (!$this->hasPrimaryActorNameRepositoryHandler()) {
            throw new \LogicException('PrimaryActorNameRepositoryHandler is not set.');
        }
        unset($this->PrimaryActorNameRepositoryHandler);

        return $this;
    }
}
