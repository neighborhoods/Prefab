<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Repository;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\RepositoryInterface;

trait AwareTrait
{
    protected $PrimaryActorNameMapRepository;

    public function setPrimaryActorNameRepository(RepositoryInterface $PrimaryActorNameRepository): self
    {
        if ($this->hasPrimaryActorNameRepository()) {
            throw new \LogicException('PrimaryActorNameRepository is already set.');
        }
        $this->PrimaryActorNameRepository = $PrimaryActorNameRepository;

        return $this;
    }

    protected function getPrimaryActorNameRepository(): RepositoryInterface
    {
        if (!$this->hasPrimaryActorNameRepository()) {
            throw new \LogicException('PrimaryActorNameMapRepository is not set.');
        }

        return $this->PrimaryActorNameMapRepository;
    }

    protected function hasPrimaryActorNameRepository(): bool
    {
        return isset($this->PrimaryActorNameMapRepository);
    }

    protected function unsetPrimaryActorNameRepository(): self
    {
        if (!$this->hasPrimaryActorNameRepository()) {
            throw new \LogicException('PrimaryActorNameRepository is not set.');
        }
        unset($this->PrimaryActorNameRepository);

        return $this;
    }
}
