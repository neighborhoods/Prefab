<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Psr\Log\AbstractLogger;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class Logger extends AbstractLogger implements Prefab5\LoggerInterface
{
    protected $log_file_path;
    protected $file_resource;

    public function log($level, $message, array $context = [])
    {
        $logRecord = [
            $level,
            'message' => $message,
            'context' => $context
        ];

        fwrite($this->getLogFileResource(), json_encode($logRecord));
    }

    protected function getLogFilePath() : string
    {
        if ($this->log_file_path === null) {
            throw new \LogicException('Logger log_file_path has not been set.');
        }
        return $this->log_file_path;
    }

    public function setLogFilePath(string $log_file_path) : Prefab5\LoggerInterface
    {
        if ($this->log_file_path !== null) {
            throw new \LogicException('Logger log_file_path is already set.');
        }
        $this->log_file_path = $log_file_path;
        return $this;
    }

    protected function getLogFileResource()
    {
        if ($this->file_resource === null) {
            $file = fopen($this->getLogFilePath(), 'a');
            if ($file === false) {
                throw (new Prefab5\Logger\Exception())->setCode(Prefab5\Logger\Exception::CODE_FILE_OPEN_FAILED);
            }

            $this->file_resource = $file;
        }

        return $this->file_resource;
    }

}
