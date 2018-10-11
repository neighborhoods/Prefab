<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap;

    public function setDoctrineDBALConnectionDecoratorMap(MapInterface $doctrineDBALConnectionDecoratorMap): self
    {
        if ($this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap = $doctrineDBALConnectionDecoratorMap;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMap(): MapInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap;
    }

    protected function hasDoctrineDBALConnectionDecoratorMap(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMap(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap);

        return $this;
    }
}
