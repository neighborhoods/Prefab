<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Acceptance;

use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class TestEnvironment
{
    private const DOCKER_IMAGE_NAME = 'prefab-test-app';

    private const COMMAND_BUILD_DOCKER = 'docker-compose build';

    private const COMMAND_RUN_DOCKER = 'docker-compose up -d';

    private const COMMAND_STOP_DOCKER = 'docker-compose down --remove-orphans';

    private const COMMAND_INSTALL_COMPOSER_DEPS = 'docker-compose exec -T ' .
        self::DOCKER_IMAGE_NAME .
        ' composer update --prefer-source';

    /**
     * @var string
     */
    private $dockerImageId;

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $filesystem;

    private function __construct(Filesystem $filesystem)
    {
        // Must use named constructor `TestEnvironment::start`

        $this->filesystem = $filesystem;
    }

    public static function start(): TestEnvironment
    {
        $testEnv = new TestEnvironment(new Filesystem());

        $testEnv->run();

        return $testEnv;
    }

    public function run(): void
    {
        try {
            $this->filesystem->remove(static::testAppRoot() . '/*');
            $this->filesystem->copy(
                static::testAppOriginalStateRoot(),
                static::testAppRoot()
            );
            $this
                ->buildDockerImage()
                ->runDockerImage()
                ->installComposerDependencies();
        } catch (Exception $e) {
            echo static::redText("Failed to create test environment:\n\n");
            echo static::redText($e->getMessage());
            echo static::redText($e->getTraceAsString());
            echo static::redText("\n");
            $this->stopDockerImage();
        }
    }

    public function stopDockerImage(): TestEnvironment
    {
        $process = $this->createProcess(self::COMMAND_STOP_DOCKER);

        $process->mustRun(self::printCommandOutput());

        return $this;
    }

    private static function projectRoot(): string
    {
        return __DIR__ . '/../..';
    }

    private static function testAppRoot(): string
    {
        return __DIR__ . '/../test-app';
    }

    private static function testAppOriginalStateRoot(): string
    {
        return __DIR__ . '/../Acceptance/fixtures/test-app-original-state';
    }

    private static function printCommandOutput(): callable
    {
        return function (string $type, string $buffer): void
        {
            if (Process::ERR === $type) {
                echo static::redText($buffer);
            } else {
                echo $buffer;
            }
        };
    }

    private function buildDockerImage(): TestEnvironment
    {
        $process = $this->createProcess(self::COMMAND_BUILD_DOCKER);

        $process->setTimeout(null);

        $process->mustRun(self::printCommandOutput());

        return $this;
    }

    private function runDockerImage(): TestEnvironment
    {
        $process = $this->createProcess(self::COMMAND_RUN_DOCKER);

        $process->setTimeout(null);

        $process->mustRun(self::printCommandOutput());

        $this->dockerImageId = trim($process->getOutput());

        return $this;
    }

    private function installComposerDependencies(): TestEnvironment
    {
        $process = $this->createProcess(self::COMMAND_INSTALL_COMPOSER_DEPS);

        $process->setTimeout(null);

        $process->mustRun(self::printCommandOutput());

        return $this;
    }

    private function createProcess(string $cmd): Process
    {
        echo static::greenText("Running command: $cmd\n");

        return new Process($cmd, self::projectRoot());
    }

    private static function redText(string $text): string
    {
        return "\033[31m" . $text . "\033[0m";
    }

    private static function greenText(string $text): string
    {
        return "\033[32m" . $text . "\033[0m";
    }
}