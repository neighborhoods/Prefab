<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Zend\Code\Generator\ClassGenerator;

use Zend\Code\Generator\ClassGenerator;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabZendCodeGeneratorClassGenerator;

    public function setZendCodeGeneratorClassGenerator(ClassGenerator $zendCodeGeneratorClassGenerator) : self
    {
        if ($this->hasZendCodeGeneratorClassGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorClassGenerator is already set.');
        }
        $this->NeighborhoodsPrefabZendCodeGeneratorClassGenerator = $zendCodeGeneratorClassGenerator;

        return $this;
    }

    protected function getZendCodeGeneratorClassGenerator() : ClassGenerator
    {
        if (!$this->hasZendCodeGeneratorClassGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorClassGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabZendCodeGeneratorClassGenerator;
    }

    protected function hasZendCodeGeneratorClassGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabZendCodeGeneratorClassGenerator);
    }

    protected function unsetZendCodeGeneratorClassGenerator() : self
    {
        if (!$this->hasZendCodeGeneratorClassGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorClassGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabZendCodeGeneratorClassGenerator);

        return $this;
    }
}
