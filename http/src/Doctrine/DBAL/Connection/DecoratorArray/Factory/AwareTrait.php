<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArray\Factory;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArray\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory;

    public function setDoctrineDBALConnectionDecoratorArrayFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorArrayFactory
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory = $doctrineDBALConnectionDecoratorArrayFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArrayFactory(): FactoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorArrayFactory(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArrayFactory(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArrayFactory);

        return $this;
    }
}
