<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        if ($this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecorator);

        return $this;
    }
}
