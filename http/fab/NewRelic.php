<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct;

class NewRelic implements NewRelicInterface
{
    public function addCustomParameter(string $key, $value): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Attaches a custom attribute (key/value pair) to the current transaction. */
            newrelic_add_custom_parameter($key, $value);
        }

        return $this;
    }

    public function addCustomTracer(string $function_name): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Specify functions or methods for the agent to instrument with custom instrumentation. */
            newrelic_add_custom_tracer($function_name);
        }

        return $this;
    }

    public function backgroundJob(bool $flag): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Manually specify that a transaction is a background job or a web transaction. */
            newrelic_background_job($flag);
        }

        return $this;
    }

    public function captureParams(bool $enable_flag): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Enable or disable the capture of URL parameters. */
            newrelic_capture_params($enable_flag);
        }

        return $this;
    }

    public function customMetric(string $metric_name, float $value): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Add a custom metric (in milliseconds) to time a component of your app not captured by default. */
            newrelic_custom_metric($metric_name, $value);
        }

        return $this;
    }

    public function disableAutorum(): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Disable automatic injection of the New Relic Browser snippet on particular pages. */
            newrelic_disable_autorum();
        }

        return $this;
    }

    public function endOfTransaction(): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Stop timing the current transaction, but continue instrumenting it. */
            newrelic_end_of_transaction();
        }

        return $this;
    }

    public function endTransaction(bool $ignore): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Stop instrumenting the current transaction immediately. */
            newrelic_end_transaction($ignore);
        }

        return $this;
    }

    public function nameTransaction(string $name): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            /** Set custom name for current transaction. */
            newrelic_name_transaction($name);
        }

        return $this;
    }

    public function noticeMessage(string $message): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
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
        if (extension_loaded('newrelic')) {
            newrelic_notice_error($error_number, $error_string, $error_file, $error_line);
        }

        return $this;
    }

    public function noticeThrowable(\Throwable $throwable): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            newrelic_notice_error($throwable);
        }

        return $this;
    }

    public function recordCustomEvent(string $name, array $attributes): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            newrelic_record_custom_event($name, $attributes);
        }

        return $this;
    }

    public function setAppname(string $name): NewRelicInterface
    {
        if (extension_loaded('newrelic')) {
            newrelic_set_appname($name);
        }

        return $this;
    }
}
