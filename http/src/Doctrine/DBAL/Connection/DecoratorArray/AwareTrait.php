<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray;

    public function setDoctrineDBALConnectionDecoratorArray(
        DecoratorArrayInterface $doctrineDBALConnectionDecoratorArray
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray = $doctrineDBALConnectionDecoratorArray;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArray(): DecoratorArrayInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray;
    }

    protected function hasDoctrineDBALConnectionDecoratorArray(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArray(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~DoctrineDBALConnectionDecoratorArray);

        return $this;
    }
}
