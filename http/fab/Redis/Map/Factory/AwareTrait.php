<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Map\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory;

    public function setRedisMapFactory(FactoryInterface $redisMapFactory): self
    {
        if ($this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory = $redisMapFactory;

        return $this;
    }

    protected function getRedisMapFactory(): FactoryInterface
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory;
    }

    protected function hasRedisMapFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory);
    }

    protected function unsetRedisMapFactory(): self
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMapFactory);

        return $this;
    }
}
