<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

interface NewRelicInterface
{
    public const EXTENSION_NAME_NEWRELIC = 'newrelic';

    public function addCustomParameter(string $key, $value): NewRelicInterface;

    public function addCustomTracer(string $function_name): NewRelicInterface;

    public function backgroundJob(bool $flag): NewRelicInterface;

    public function captureParams(bool $enable_flag): NewRelicInterface;

    public function customMetric(string $metric_name, float $value): NewRelicInterface;

    public function disableAutorum(): NewRelicInterface;

    public function endOfTransaction(): NewRelicInterface;

    public function endTransaction(bool $ignore): NewRelicInterface;

    public function nameTransaction(string $name): NewRelicInterface;

    public function noticeMessage(string $message): NewRelicInterface;

    public function noticeThrowable(\Throwable $throwable): NewRelicInterface;

    public function recordCustomEvent(string $name, array $attributes): NewRelicInterface;

    public function setAppname(string $name): NewRelicInterface;

    public function noticeError(
        int $error_number,
        string $error_string,
        string $error_file,
        int $error_line
    ): NewRelicInterface;

    public function isExtensionLoaded(): bool;
}
