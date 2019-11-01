<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class NewRelic implements NewRelicInterface
{
    protected $is_extension_loaded;

    public function isExtensionLoaded(): bool
    {
        if ($this->is_extension_loaded === null) {
            $isExtensionLoaded = false;
            if (extension_loaded(self::EXTENSION_NAME_NEWRELIC)) {
                $isExtensionLoaded = true;
            }
            $this->is_extension_loaded = $isExtensionLoaded;
        }

        return $this->is_extension_loaded;
    }

    public function addCustomParameter(string $key, $value): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Attaches a custom attribute (key/value pair) to the current transaction. */
            newrelic_add_custom_parameter($key, $value);
        }

        return $this;
    }

    public function addCustomTracer(string $function_name): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Specify functions or methods for the agent to instrument with custom instrumentation. */
            newrelic_add_custom_tracer($function_name);
        }

        return $this;
    }

    public function backgroundJob(bool $flag): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Manually specify that a transaction is a background job or a web transaction. */
            newrelic_background_job($flag);
        }

        return $this;
    }

    public function captureParams(bool $enable_flag): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Enable or disable the capture of URL parameters. */
            newrelic_capture_params($enable_flag);
        }

        return $this;
    }

    public function customMetric(string $metric_name, float $value): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Add a custom metric (in milliseconds) to time a component of your app not captured by default. */
            newrelic_custom_metric($metric_name, $value);
        }

        return $this;
    }

    public function disableAutorum(): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Disable automatic injection of the New Relic Browser snippet on particular pages. */
            newrelic_disable_autorum();
        }

        return $this;
    }

    public function endOfTransaction(): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Stop timing the current transaction, but continue instrumenting it. */
            newrelic_end_of_transaction();
        }

        return $this;
    }

    public function endTransaction(bool $ignore): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Stop instrumenting the current transaction immediately. */
            newrelic_end_transaction($ignore);
        }

        return $this;
    }

    public function nameTransaction(string $name): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            /** Set custom name for current transaction. */
            newrelic_name_transaction($name);
        }

        return $this;
    }

    public function noticeMessage(string $message): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            newrelic_notice_error($message);
        }

        return $this;
    }

    public function noticeError(
        int $error_number,
        string $error_string,
        string $error_file,
        int $error_line
    ): NewRelicInterface {
        if ($this->isExtensionLoaded()) {
            newrelic_notice_error($error_number, $error_string, $error_file, $error_line);
        }

        return $this;
    }

    public function noticeThrowable(\Throwable $throwable): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            newrelic_notice_error($throwable);
        }

        return $this;
    }

    public function recordCustomEvent(string $name, array $attributes): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            newrelic_record_custom_event($name, $attributes);
        }

        return $this;
    }

    public function setAppname(string $name): NewRelicInterface
    {
        if ($this->isExtensionLoaded()) {
            newrelic_set_appname($name);
        }

        return $this;
    }
}
