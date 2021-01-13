<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Acceptance;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class TestEnvironment
{
    private const DOCKER_IMAGE_NAME = 'prefab-test-app';

    private const COMMAND_RUN_DOCKER = 'docker-compose up -d';

    private const COMMAND_STOP_DOCKER = 'docker-compose down --remove-orphans';

    private const COMMAND_INSTALL_COMPOSER_DEPS = 'docker-compose exec -T ' .
        self::DOCKER_IMAGE_NAME .
        ' composer update --prefer-dist';

    /**
     * @var string
     */
    private $dockerImageId;

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function start(): void
    {
        try {
            $this
                ->resetTestAppDir()
                ->runDockerImage()
                ->installComposerDependencies();
        } catch (\Exception $e) {
            echo static::redText("Failed to create test environment:\n\n");
            echo static::redText($e->getMessage());
            echo static::redText($e->getTraceAsString());
            echo static::redText("\n");

            while (null !== $e->getPrevious()) {
                echo static::redText($e->getMessage());
                echo static::redText($e->getTraceAsString());
                echo static::redText("\n");
            }
        }
    }

    public function resetTestAppDir(): TestEnvironment
    {
        $this->deleteFilesAndDirsInTestAppDir();

        $this->copyAppFixtureToTestAppRoot();

        return $this;
    }

    public function runCommandInTestEnvironment(string $cmd): Process
    {
        $process = new Process(
            sprintf(
                'docker-compose exec -T %s %s',
                static::DOCKER_IMAGE_NAME,
                $cmd
            ),
            self::projectRoot()
        );

        $process->run();

        return $process;
    }

    public function stop(): TestEnvironment
    {
        $process = $this->createProcess(self::COMMAND_STOP_DOCKER);

        $process->mustRun(self::printCommandOutput());

        return $this;
    }

    public static function testAppRoot(): string
    {
        return __DIR__ . '/../test-app';
    }

    private function deleteFilesAndDirsInTestAppDir(): void
    {
        $finder = new Finder();

        $dirsToRemove = $finder->in(static::testAppRoot())
            ->directories()
            ->exclude('vendor')
            ->getIterator();

        $this->filesystem->remove($dirsToRemove);

        $filesToRemove = $finder->in(static::testAppRoot())
            ->files()
            ->getIterator();

        $this->filesystem->remove($filesToRemove);
    }

    private function copyAppFixtureToTestAppRoot(): void
    {
        $this->filesystem->mirror(
            static::testAppOriginalStateRoot(),
            static::testAppRoot()
        );
    }

    private static function projectRoot(): string
    {
        return __DIR__ . '/../..';
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
