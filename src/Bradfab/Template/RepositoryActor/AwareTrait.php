<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\RepositoryActor;

use Neighborhoods\Prefab\Bradfab\Template\RepositoryActorInterface;

trait AwareTrait
{
    protected $RepositoryActor;

    public function setRepositoryActor(RepositoryActorInterface $RepositoryActor): self
    {
        if ($this->hasRepositoryActor()) {
            throw new \LogicException('RepositoryActor is already set.');
        }
        $this->RepositoryActor = $RepositoryActor;

        return $this;
    }

    protected function getRepositoryActor(): RepositoryActorInterface
    {
        if (!$this->hasRepositoryActor()) {
            throw new \LogicException('RepositoryActor is not set.');
        }

        return $this->RepositoryActor;
    }

    protected function hasRepositoryActor(): bool
    {
        return isset($this->RepositoryActor);
    }

    protected function unsetRepositoryActor(): self
    {
        if (!$this->hasRepositoryActor()) {
            throw new \LogicException('RepositoryActor is not set.');
        }
        unset($this->RepositoryActor);

        return $this;
    }
}
