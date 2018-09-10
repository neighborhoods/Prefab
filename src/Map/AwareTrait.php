<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Map;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapTemplate;

    public function setTemplate(Template $template): self
    {
        if ($this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapTemplate is already set.');
        }
        $this->NeighborhoodsPrefabMapTemplate = $template;

        return $this;
    }

    protected function getTemplate(): Template
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapTemplate is not set.');
        }

        return $this->NeighborhoodsPrefabMapTemplate;
    }

    protected function hasTemplate(): bool
    {
        return isset($this->NeighborhoodsPrefabMapTemplate);
    }

    protected function unsetTemplate(): self
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabMapTemplate is not set.');
        }
        unset($this->NeighborhoodsPrefabMapTemplate);

        return $this;
    }
}
