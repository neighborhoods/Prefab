<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache;

class DNS implements DNSInterface
{
    /** @var string */
    protected $ip;
    /** @var string */
    protected $host;

    protected function set($key, $value): DNSInterface
    {
        $temporaryFileName = $this->getCacheDirectoryPath() . $key . uniqid('', true) . '.tmp';
        file_put_contents($temporaryFileName, '<?php $value = ' . var_export($value, true) . ';');
        rename($temporaryFileName, $this->getCacheFilePath());

        return $this;
    }

    protected function get()
    {
        @include $this->getCacheFilePath();

        return $value ?? false;
    }

    public function flush(): DNSInterface
    {
        opcache_invalidate($this->getCacheFilePath(), true);
        unlink($this->getCacheFilePath());

        return $this;
    }

    public function getIp(): string
    {
        if ($this->ip === null) {
            $ip = $this->get();
            if ($ip === false) {
                $this->ip = gethostbyname($this->getHost());
                $this->set($this->getHost(), $this->ip);
            } else {
                $this->ip = $ip;
            }
        }

        return $this->ip;
    }

    protected function getHost(): string
    {
        if ($this->host === null) {
            throw new \LogicException('DNSCache host has not been set.');
        }

        return $this->host;
    }

    public function setHost(string $host_name): DNSInterface
    {
        if ($this->host !== null) {
            throw new \LogicException('DNSCache host is already set.');
        } elseif (filter_var($host_name, FILTER_VALIDATE_IP) !== false) {
            $this->ip = $host_name;
        } else {
            $this->host = $host_name;
        }

        return $this;
    }

    protected function getCacheDirectoryPath(): string
    {
        return self::CACHE_DIRECTORY_PATH;
    }

    protected function getCacheFilePath()
    {
        return $this->getCacheDirectoryPath() . $this->getHost() . '.php';
    }
}