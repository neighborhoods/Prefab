<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator\Repository;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository;

    public function setDoctrineDBALConnectionDecoratorRepository(
        RepositoryInterface $doctrineDBALConnectionDecoratorRepository
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository is already set.'));
        $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository = $doctrineDBALConnectionDecoratorRepository;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorRepository(): RepositoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository is not set.'));

        return $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository;
    }

    protected function hasDoctrineDBALConnectionDecoratorRepository(): bool
    {
        return isset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository);
    }

    protected function unsetDoctrineDBALConnectionDecoratorRepository(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository is not set.'));
        unset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorRepository);

        return $this;
    }
}
