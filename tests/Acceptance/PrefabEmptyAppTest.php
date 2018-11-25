<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Acceptance;

use PHPUnit\Framework\TestCase;

class PrefabEmptyAppTest extends TestCase
{
    /**
     * @var \Neighborhoods\PrefabTest\Acceptance\TestEnvironment
     */
    protected $testEnvironment;

    protected function setUp()
    {
        parent::setUp();

        $this->testEnvironment = TestEnvironmentFacade::getEnvironment();

        $this->testEnvironment->resetTestAppDir();
    }

    /**
     * @test
     */
    public function shouldReturnErrorIfConfigurationYamlNotSet(): void
    {
        $process = $this->testEnvironment->runCommandInTestEnvironment(
            'vendor/bin/prefab'
        );

        static::assertSame(
            255,
            $process->getExitCode()
        );

        static::assertContains(
            'Generator buildPlans has not been set.',
            $process->getOutput()
        );
    }
}