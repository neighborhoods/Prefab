<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis;

class Factory implements FactoryInterface
{
    protected $options = [];
    protected $port;
    protected $host;

    public function create(): \Redis
    {
        $redis = new \Redis();
        $redis->connect($this->getHost(), $this->getPort());
        if ($this->hasOptions()) {
            foreach ($this->_getOptions() as $optionName => $optionValue) {
                $redis->setOption($optionName, $optionValue);
            }
        }

        return $redis;
    }

    public function setPort(?int $port): FactoryInterface
    {
        if ($port !== null) {
            if ($this->port !== null) {
                throw new \LogicException('Port is already set.');
            }

            $this->port = $port;
        }

        return $this;
    }

    protected function getPort(): int
    {
        if ($this->port === null) {
            throw new \LogicException('Port is not set.');
        }

        return $this->port;
    }

    public function setHost(?string $host): FactoryInterface
    {
        if ($host !== null) {
            if ($this->host !== null) {
                throw new \LogicException('Host is already set.');
            }

            $this->host = $host;
        }

        return $this;
    }

    protected function getHost(): string
    {
        if ($this->host === null) {
            throw new \LogicException('Host is not set.');
        }

        return $this->host;
    }

    public function addOption(int $optionName, string $optionValue): FactoryInterface
    {
        if (isset($this->options[$optionName])) {
            $optionValue = $this->options[$optionName];
            throw new \LogicException("Option [$optionName] is already set with value [$optionValue].");
        }

        $this->options[$optionName] = $optionValue;

        return $this;
    }

    protected function hasOptions(): bool
    {
        return !empty($this->options);
    }

    protected function _getOptions(): array
    {
        return $this->options;
    }
}
