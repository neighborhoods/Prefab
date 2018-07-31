<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory;

    public function setRedisFactory(FactoryInterface $redisFactory): self
    {
        if ($this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory = $redisFactory;

        return $this;
    }

    protected function getRedisFactory(): FactoryInterface
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory;
    }

    protected function hasRedisFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory);
    }

    protected function unsetRedisFactory(): self
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisFactory);

        return $this;
    }
}
