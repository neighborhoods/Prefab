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

    /**
     * @test
     */
    public function shouldGenerateSimpleDao(): void
    {
        $expectedOutput = <<<EOF
>> Copying the skeleton...
>> Success.
>> Assembling the Prefab build plan...
>> Success.
>> Generating Prefab machinery...
>> Success.
>> Protean Prefab complete.
EOF;

        $daoYaml = <<<EOF
dao:
  table_name: users
  identity_field: id
  http_route: /users/{searchCriteria:}
  properties:
    id:
      php_type: string
      database_column_name: id
    username:
      php_type: string
      database_column_name: username
    email:
      php_type: string
      database_column_name: email
EOF;

        mkdir(
            $this->testEnvironment::testAppRoot() . '/src/TEST'
        );

        file_put_contents(
            $this->testEnvironment::testAppRoot() . '/src/TEST/User.prefab.definition.yml',
            $daoYaml
        );

        $process = $this->testEnvironment->runCommandInTestEnvironment(
            'vendor/bin/prefab'
        );

        static::assertSame(
            0,
            $process->getExitCode()
        );

        static::assertSame(
            trim($expectedOutput),
            trim($process->getOutput())
        );
    }
}