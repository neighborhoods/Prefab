<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\Factory;

use Neighborhoods\Prefab\Bradfab\Template\FactoryInterface;

trait AwareTrait
{
    protected $TemplateFactory;

    public function setTemplateFactory(FactoryInterface $TemplateFactory): self
    {
        if ($this->hasTemplateFactory()) {
            throw new \LogicException('TemplateFactory is already set.');
        }
        $this->TemplateFactory = $TemplateFactory;

        return $this;
    }

    protected function getTemplateFactory(): FactoryInterface
    {
        if (!$this->hasTemplateFactory()) {
            throw new \LogicException('TemplateFactory is not set.');
        }

        return $this->TemplateFactory;
    }

    protected function hasTemplateFactory(): bool
    {
        return isset($this->TemplateFactory);
    }

    protected function unsetTemplateFactory(): self
    {
        if (!$this->hasTemplateFactory()) {
            throw new \LogicException('TemplateFactory is not set.');
        }
        unset($this->TemplateFactory);

        return $this;
    }
}
