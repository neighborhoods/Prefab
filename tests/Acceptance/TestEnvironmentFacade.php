<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Acceptance;

use Symfony\Component\Filesystem\Filesystem;

class TestEnvironmentFacade
{
    /**
     * @var \Neighborhoods\PrefabTest\Acceptance\TestEnvironment
     */
    private static $testEnvironment;

    public static function start(): TestEnvironment
    {
        if (isset(static::$testEnvironment)) {
            throw new \RuntimeException(
                'Test environment already created. Cannot create multiple test environments.'
            );
        }

        static::$testEnvironment = new TestEnvironment(new Filesystem());

        static::$testEnvironment->start();

        return static::$testEnvironment;
    }

    public static function stop(): void
    {
        if (!isset(static::$testEnvironment)) {
            throw new \RuntimeException('No test environment to stop.');
        }

        static::$testEnvironment->stop();
    }

    public static function getEnvironment(): TestEnvironment
    {
        if (!isset(static::$testEnvironment)) {
            throw new \RuntimeException('No test environment started.');
        }

        return static::$testEnvironment;
    }
}