<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapInterfaceTemplate;

    public function setTemplate(Template $template): self
    {
        if ($this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceTemplate is already set.');
        }
        $this->NeighborhoodsPrefabMapInterfaceTemplate = $template;

        return $this;
    }

    protected function getTemplate(): Template
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceTemplate is not set.');
        }

        return $this->NeighborhoodsPrefabMapInterfaceTemplate;
    }

    protected function hasTemplate(): bool
    {
        return isset($this->NeighborhoodsPrefabMapInterfaceTemplate);
    }

    protected function unsetTemplate(): self
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceTemplate is not set.');
        }
        unset($this->NeighborhoodsPrefabMapInterfaceTemplate);

        return $this;
    }
}
