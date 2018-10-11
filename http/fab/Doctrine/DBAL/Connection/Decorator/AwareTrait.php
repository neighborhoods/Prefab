<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        if ($this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator);

        return $this;
    }
}
