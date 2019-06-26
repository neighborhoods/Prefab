<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\RepositoryActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\RepositoryActor\FactoryInterface;

trait AwareTrait
{
    protected $RepositoryActorFactory;

    public function setRepositoryActorFactory(FactoryInterface $RepositoryActorFactory): self
    {
        if ($this->hasRepositoryActorFactory()) {
            throw new \LogicException('RepositoryActorFactory is already set.');
        }
        $this->RepositoryActorFactory = $RepositoryActorFactory;

        return $this;
    }

    protected function getRepositoryActorFactory(): FactoryInterface
    {
        if (!$this->hasRepositoryActorFactory()) {
            throw new \LogicException('RepositoryActorFactory is not set.');
        }

        return $this->RepositoryActorFactory;
    }

    protected function hasRepositoryActorFactory(): bool
    {
        return isset($this->RepositoryActorFactory);
    }

    protected function unsetRepositoryActorFactory(): self
    {
        if (!$this->hasRepositoryActorFactory()) {
            throw new \LogicException('RepositoryActorFactory is not set.');
        }
        unset($this->RepositoryActorFactory);

        return $this;
    }
}
