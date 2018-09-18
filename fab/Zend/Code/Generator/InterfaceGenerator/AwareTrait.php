<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Zend\Code\Generator\InterfaceGenerator;

use Zend\Code\Generator\InterfaceGenerator;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator;

    public function setZendCodeGeneratorInterfaceGenerator(
        InterfaceGenerator $zendCodeGeneratorInterfaceGenerator
    ) : self {
        if ($this->hasZendCodeGeneratorInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator = $zendCodeGeneratorInterfaceGenerator;

        return $this;
    }

    protected function getZendCodeGeneratorInterfaceGenerator() : InterfaceGenerator
    {
        if (!$this->hasZendCodeGeneratorInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator;
    }

    protected function hasZendCodeGeneratorInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator);
    }

    protected function unsetZendCodeGeneratorInterfaceGenerator() : self
    {
        if (!$this->hasZendCodeGeneratorInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabZendCodeGeneratorInterfaceGenerator);

        return $this;
    }
}
