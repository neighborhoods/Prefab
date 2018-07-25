<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        assert(!$this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        assert($this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        assert($this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecorator);

        return $this;
    }
}
