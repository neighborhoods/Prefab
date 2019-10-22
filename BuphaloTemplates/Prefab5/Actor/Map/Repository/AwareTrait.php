<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map\Repository;

use Neighborhoods\BuphaloTemplateTree\Actor\Map\RepositoryInterface;

trait AwareTrait
{
    protected $ActorMapRepository;

    public function setActorMapRepository(RepositoryInterface $ActorMapRepository): self
    {
        if ($this->hasActorMapRepository()) {
            throw new \LogicException('ActorMapRepository is already set.');
        }
        $this->ActorMapRepository = $ActorMapRepository;

        return $this;
    }

    protected function getActorMapRepository(): RepositoryInterface
    {
        if (!$this->hasActorMapRepository()) {
            throw new \LogicException('ActorMapRepository is not set.');
        }

        return $this->ActorMapRepository;
    }

    protected function hasActorMapRepository(): bool
    {
        return isset($this->ActorMapRepository);
    }

    protected function unsetActorMapRepository(): self
    {
        if (!$this->hasActorMapRepository()) {
            throw new \LogicException('ActorMapRepository is not set.');
        }
        unset($this->ActorMapRepository);

        return $this;
    }
}
