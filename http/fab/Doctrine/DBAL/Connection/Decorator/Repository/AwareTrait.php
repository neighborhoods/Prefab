<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\Repository;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository;

    public function setDoctrineDBALConnectionDecoratorRepository(
        RepositoryInterface $doctrineDBALConnectionDecoratorRepository
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository = $doctrineDBALConnectionDecoratorRepository;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorRepository(): RepositoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository;
    }

    protected function hasDoctrineDBALConnectionDecoratorRepository(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository);
    }

    protected function unsetDoctrineDBALConnectionDecoratorRepository(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorRepository);

        return $this;
    }
}
