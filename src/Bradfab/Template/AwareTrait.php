<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

use Neighborhoods\Prefab\Bradfab\TemplateInterface;

trait AwareTrait
{
    protected $Template;

    public function setTemplate(TemplateInterface $Template): self
    {
        if ($this->hasTemplate()) {
            throw new \LogicException('Template is already set.');
        }
        $this->Template = $Template;

        return $this;
    }

    protected function getTemplate(): TemplateInterface
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('Template is not set.');
        }

        return $this->Template;
    }

    protected function hasTemplate(): bool
    {
        return isset($this->Template);
    }

    protected function unsetTemplate(): self
    {
        if (!$this->hasTemplate()) {
            throw new \LogicException('Template is not set.');
        }
        unset($this->Template);

        return $this;
    }
}
