<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Repository;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository;

    public function setDoctrineDBALConnectionDecoratorRepository(
        RepositoryInterface $doctrineDBALConnectionDecoratorRepository
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository = $doctrineDBALConnectionDecoratorRepository;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorRepository(): RepositoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository;
    }

    protected function hasDoctrineDBALConnectionDecoratorRepository(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository);
    }

    protected function unsetDoctrineDBALConnectionDecoratorRepository(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorRepository);

        return $this;
    }
}
