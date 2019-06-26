<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory;

    public function setPrefab5LoggerFactory(FactoryInterface $prefab5LoggerFactory) : self
    {
        if ($this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory = $prefab5LoggerFactory;

        return $this;
    }

    protected function getPrefab5LoggerFactory() : FactoryInterface
    {
        if (!$this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory;
    }

    protected function hasPrefab5LoggerFactory() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory);
    }

    protected function unsetPrefab5LoggerFactory() : self
    {
        if (!$this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory);

        return $this;
    }
}
