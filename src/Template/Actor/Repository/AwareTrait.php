<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Repository;

use Neighborhoods\Bradfab\Template\Actor\RepositoryInterface;

trait AwareTrait
{
    protected $ActorRepository;

    public function setActorRepository(RepositoryInterface $ActorRepository): self
    {
        if ($this->hasActorRepository()) {
            throw new \LogicException('ActorRepository is already set.');
        }
        $this->ActorRepository = $ActorRepository;

        return $this;
    }

    protected function getActorRepository(): RepositoryInterface
    {
        if (!$this->hasActorRepository()) {
            throw new \LogicException('ActorRepository is not set.');
        }

        return $this->ActorRepository;
    }

    protected function hasActorRepository(): bool
    {
        return isset($this->ActorRepository);
    }

    protected function unsetActorRepository(): self
    {
        if (!$this->hasActorRepository()) {
            throw new \LogicException('ActorRepository is not set.');
        }
        unset($this->ActorRepository);

        return $this;
    }
}
