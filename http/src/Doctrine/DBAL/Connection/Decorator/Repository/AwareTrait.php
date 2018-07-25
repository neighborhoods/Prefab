<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator\Repository;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository;

    public function setDoctrineDBALConnectionDecoratorRepository(
        RepositoryInterface $doctrineDBALConnectionDecoratorRepository
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository = $doctrineDBALConnectionDecoratorRepository;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorRepository(): RepositoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository;
    }

    protected function hasDoctrineDBALConnectionDecoratorRepository(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository);
    }

    protected function unsetDoctrineDBALConnectionDecoratorRepository(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorRepository(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorRepository);

        return $this;
    }
}
