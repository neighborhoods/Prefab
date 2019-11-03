<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS\Exception;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;

class DNS implements DNSInterface
{
    use Opcache\DNS\ErrorHandler\AwareTrait;
    use NewRelic\AwareTrait;
    /** @var string */
    protected $ip;
    /** @var string */
    protected $host;

    protected function set(string $key, string $value): DNSInterface
    {
        $temporaryFileName = sprintf('%s/%s%s.tmp', $this->getCacheDirectoryPath(), $key, uniqid('', true));
        try {
            $temporaryFileContents = sprintf('<?php $value = %s;', var_export($value, true));
            if (file_put_contents($temporaryFileName, $temporaryFileContents, LOCK_EX) === false) {
                throw (new Exception())->setCode(Exception::CODE_FILE_PUT_CONTENTS_FAILED);
            } else {
                if (rename($temporaryFileName, $this->getCacheFilePath()) === false) {
                    throw (new Exception())->setCode(Exception::CODE_RENAME_FAILED);
                }
            }
        } catch (Exception $exception) {
            $this->getNewRelic()->noticeThrowable($exception);
        }

        return $this;
    }

    protected function get()
    {
        set_error_handler($this->getOpcacheDNSErrorHandler());
        /** @noinspection PhpIncludeInspection */
        include $this->getCacheFilePath();
        restore_error_handler();

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
                if ($this->ip !== $this->getHost()) {
                    $this->set($this->getHost(), $this->ip);
                } else {
                    throw (new Exception())->setCode(Exception::CODE_GET_HOST_BY_NAME_FAILED);
                }
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
        return sprintf('%s/%s.php', $this->getCacheDirectoryPath(), $this->getHost());
    }
}
