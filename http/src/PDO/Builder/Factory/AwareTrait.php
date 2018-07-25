<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\PDO\Builder\Factory;

use Neighborhoods\~~PROJECT NAME~~\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~PDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        assert(!$this->hasPDOBuilderFactory(),
            new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilderFactory is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~PDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        assert($this->hasPDOBuilderFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilderFactory is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~PDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~PDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        assert($this->hasPDOBuilderFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilderFactory is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~PDOBuilderFactory);

        return $this;
    }
}
