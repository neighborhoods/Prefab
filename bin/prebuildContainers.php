#!/usr/bin/env php
<?php
declare(strict_types=1);
error_reporting(E_ALL);
set_error_handler(function (
    int $errorNumber,
    string $errorString,
    string $errorFile,
    int $errorLine,
    array $errorContext
) {
    throw new \ErrorException($errorString, $errorNumber, $errorNumber, $errorFile, $errorLine);
});

require_once __DIR__ . '/../../../../vendor/autoload.php';

$prebuilder = new Prebuilder();
$prebuilder->prebuildContainers();

return;

