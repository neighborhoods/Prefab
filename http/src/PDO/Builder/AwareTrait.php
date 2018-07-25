<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\PDO\Builder;

use Neighborhoods\~~PROJECT NAME~~\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~PDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        assert(!$this->hasPDOBuilder(), new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilder is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~PDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        assert($this->hasPDOBuilder(), new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilder is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~PDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~PDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        assert($this->hasPDOBuilder(), new \LogicException('Neighborhoods~~PROJECT NAME~~PDOBuilder is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~PDOBuilder);

        return $this;
    }
}
