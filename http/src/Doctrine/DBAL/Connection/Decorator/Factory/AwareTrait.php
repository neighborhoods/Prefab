<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator\Factory;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}
