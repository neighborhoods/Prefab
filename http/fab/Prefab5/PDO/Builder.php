<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

class Builder implements BuilderInterface
{
    use Opcache\DNS\AwareTrait;
    /** @link https://docstore.mik.ua/orelly/java-ent/jenut/ch08_06.htm */
    public const SQLSTATE_CONNECTION_FAILURE = 'SQLSTATE[08006]';
    protected $pdo;
    protected $database_host;
    protected $database_adapter;
    protected $database_name;
    protected $data_source_name;
    protected $user_name;
    protected $password;
    protected $options;
    protected $data_source_name_from_opcache_dns;

    public function getPdo(): \PDO
    {
        if ($this->pdo === null) {
            $userName = $this->getUserName();
            $password = $this->getPassword();
            if ($this->hasOptions()) {
                $options = $this->getOptions();
            } else {
                $options = [];
            }
            try {
                $this->pdo = new \PDO($this->getDataSourceNameFromOpcacheDNS(), $userName, $password, $options);
            } catch (\PDOException $PDOException) {
                if (strstr($PDOException->getMessage(), self::SQLSTATE_CONNECTION_FAILURE)) {
                    $this->getOpcacheDNS()->flush();
                    $this->pdo = new \PDO($this->getDataSourceName(), $userName, $password, $options);
                } else {
                    throw $PDOException;
                }
            } catch (Opcache\DNS\Exception $opcacheDNSException) {
                $this->pdo = new \PDO($this->getDataSourceName(), $userName, $password, $options);
            }
        }

        return $this->pdo;
    }

    public function getDatabaseHost(): string
    {
        if ($this->database_host === null) {
            throw new \LogicException('Builder database_host has not been set.');
        }

        return $this->database_host;
    }

    public function setDatabaseHost(string $database_host): BuilderInterface
    {
        if ($this->database_host !== null) {
            throw new \LogicException('Builder database_host is already set.');
        }
        $this->database_host = $database_host;

        return $this;
    }

    public function getDatabaseAdapter(): string
    {
        if ($this->database_adapter === null) {
            throw new \LogicException('Builder database_adapter has not been set.');
        }

        return $this->database_adapter;
    }

    public function setDatabaseAdapter(string $database_adapter): BuilderInterface
    {
        if ($this->database_adapter !== null) {
            throw new \LogicException('Builder database_adapter is already set.');
        }
        $this->database_adapter = $database_adapter;

        return $this;
    }

    public function getDatabaseName(): string
    {
        if ($this->database_name === null) {
            throw new \LogicException('Builder database_name has not been set.');
        }

        return $this->database_name;
    }

    public function setDatabaseName(string $database_name): BuilderInterface
    {
        if ($this->database_name !== null) {
            throw new \LogicException('Builder database_name is already set.');
        }
        $this->database_name = $database_name;

        return $this;
    }

    protected function getDataSourceNameFromOpcacheDNS(): string
    {
        if ($this->data_source_name_from_opcache_dns === null) {
            $ip = $this->getOpcacheDNS()->setHost($this->getDatabaseHost())->getIp();
            $dsn = $this->generateDSN($this->getDatabaseAdapter(), $this->getDatabaseName(), $ip);
            $this->data_source_name_from_opcache_dns = $dsn;
        }

        return $this->data_source_name_from_opcache_dns;
    }

    protected function getDataSourceName(): string
    {
        if ($this->data_source_name === null) {
            $dsn = $this->generateDSN($this->getDatabaseAdapter(), $this->getDatabaseName(), $this->getDatabaseHost());
            $this->data_source_name = $dsn;
        }

        return $this->data_source_name;
    }

    protected function generateDSN(string $adapter, string $name, string $host): string
    {
        return sprintf('%s:dbname=%s;host=%s', $adapter, $name, $host);
    }

    public function setUserName(string $userName): BuilderInterface
    {
        if ($this->user_name === null) {
            $this->user_name = $userName;
        } else {
            throw new \LogicException('User name is already set.');
        }

        return $this;
    }

    protected function getUserName(): string
    {
        if ($this->user_name === null) {
            throw new \LogicException('User name is not set.');
        }

        return $this->user_name;
    }

    public function setPassword(string $password): BuilderInterface
    {
        if ($this->password === null) {
            $this->password = $password;
        } else {
            throw new \LogicException('Password is already set.');
        }

        return $this;
    }

    protected function getPassword(): string
    {
        if ($this->password == null) {
            throw new \LogicException('Password is not set.');
        }

        return $this->password;
    }

    public function setOptions(array $options): BuilderInterface
    {
        if ($this->options === null) {
            $this->options = $options;
        } else {
            throw new \LogicException('Options is already set.');
        }

        return $this;
    }

    protected function getOptions(): array
    {
        if (!$this->hasOptions()) {
            throw new \LogicException('Options is not set.');
        }

        return $this->options;
    }

    protected function hasOptions(): bool
    {
        return $this->options === null ? false : true;
    }
}
