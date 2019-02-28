<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Psr\Log\LoggerInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class Logger implements Prefab5\LoggerInterface, \Psr\Log\LoggerInterface
{

    protected const LOG_LEVEL_EMERGENCY = 'EMERGENCY';
    protected const LOG_LEVEL_ALERT = 'ALERT';
    protected const LOG_LEVEL_CRITICAL = 'CRITICAL';
    protected const LOG_LEVEL_ERROR = 'ERROR';
    protected const LOG_LEVEL_WARNING = 'WARNING';
    protected const LOG_LEVEL_NOTICE = 'NOTICE';
    protected const LOG_LEVEL_INFO = 'INFO';
    protected const LOG_LEVEL_DEBUG = 'DEBUG';

    protected $log_file_path;
    protected $file_resource;


    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->log(self::LOG_LEVEL_DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
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
