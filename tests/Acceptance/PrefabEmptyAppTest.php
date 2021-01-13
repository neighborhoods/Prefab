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
        $daoYaml = <<<EOF
dao:
  table_name: users
  identity_field: id
  http_route: /users/{searchCriteria:}
  properties:
    id:
      data_type: string
      record_key: id
    username:
      data_type: string
      record_key: username
    email:
      data_type: string
      record_key: email
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
    }
}
