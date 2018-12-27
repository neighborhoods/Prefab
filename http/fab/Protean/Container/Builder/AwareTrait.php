<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container\BuilderInterface;

trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder;

    public function setProteanContainerBuilder(BuilderInterface $proteanContainerBuilder): self
    {
        if ($this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder = $proteanContainerBuilder;

        return $this;
    }

    protected function getProteanContainerBuilder(): BuilderInterface
    {
        if (!$this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder;
    }

    protected function hasProteanContainerBuilder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder);
    }

    protected function unsetProteanContainerBuilder(): self
    {
        if (!$this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilder);

        return $this;
    }
}
