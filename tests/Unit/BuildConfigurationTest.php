<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit;

use Neighborhoods\Prefab\BuildConfiguration;
use PHPUnit\Framework\TestCase;

class BuildConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function shouldPreventGettingUnsetTableName(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration tableName has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getTableName();
    }

    /**
     * @test
     */
    public function settingTableNameShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setTableName('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetTableName(): void
    {
        $expected = 'some_table';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setTableName($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getTableName()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingTableNameMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration tableName is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setTableName('unimportant');
        $buildConfiguration->setTableName('unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetDaoIdentityField(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration daoIdentityField has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getDaoIdentityField();
    }

    /**
     * @test
     */
    public function settingDaoIdentityFieldShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setDaoIdentityField('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetDaoIdentityField(): void
    {
        $expected = 'someIdField';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setDaoIdentityField($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getDaoIdentityField()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingDaoIdentityFieldMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration daoIdentityField is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setDaoIdentityField('unimportant');
        $buildConfiguration->setDaoIdentityField('unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetDaoProperties(): void
    {
        $this->markTestSkipped(
            'This test will fail because of a known bug in BuildConfiguration. See https://55places.atlassian.net/browse/PREF-80'
        );

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration daoProperties has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getDaoProperties();
    }

    /**
     * @test
     */
    public function appendingDaoPropertyShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->appendDaoProperty('unimportant', [])
        );
    }

    /**
     * @test
     */
    public function shouldAppendDaoProperties(): void
    {
        $expected = [
            'foo' => [
                'a',
                'b',
                'c',
            ],
            'bar' => ['hello world'],
            'baz' => [],
        ];

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->appendDaoProperty('foo', $expected['foo']);
        $buildConfiguration->appendDaoProperty('bar', $expected['bar']);
        $buildConfiguration->appendDaoProperty('baz', $expected['baz']);

        $this->assertSame(
            $expected,
            $buildConfiguration->getDaoProperties()
        );
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetRootSaveLocation(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectDirectory has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getRootSaveLocation();
    }

    /**
     * @test
     */
    public function settingRootSaveLocationShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setRootSaveLocation('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetRootSaveLocation(): void
    {
        $expected = '/some/root/save/location';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setRootSaveLocation($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getRootSaveLocation()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingRootSaveLocationMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectDirectory is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setRootSaveLocation('unimportant');
        $buildConfiguration->setRootSaveLocation('unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetProjectName(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectName has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getProjectName();
    }

    /**
     * @test
     */
    public function settingProjectNameShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setProjectName('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetProjectName(): void
    {
        $expected = 'some-project-name';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setProjectName($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getProjectName()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingProjectNameMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectName is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setProjectName('unimportant');
        $buildConfiguration->setProjectName('unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetHttpRoute(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration httpRoute has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getHttpRoute();
    }

    /**
     * @test
     */
    public function settingHttpRouteShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setHttpRoute('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetHttpRoute(): void
    {
        $expected = '/some-http/route';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setHttpRoute($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getHttpRoute()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingHttpRouteMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration httpRoute is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setHttpRoute('unimportant');
        $buildConfiguration->setHttpRoute('unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventGettingUnsetProjectDir(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectDir has not been set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->getProjectDir();
    }

    /**
     * @test
     */
    public function settingProjectDirShouldReturnSelf(): void
    {
        $buildConfiguration = new BuildConfiguration();

        $this->assertSame(
            $buildConfiguration,
            $buildConfiguration->setProjectDir('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldGetProjectDir(): void
    {
        $expected = '/some/project/dir';

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setProjectDir($expected);

        $this->assertSame(
            $expected,
            $buildConfiguration->getProjectDir()
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingProjectDirMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'BuildConfiguration projectDir is already set.'
        );

        $buildConfiguration = new BuildConfiguration();

        $buildConfiguration->setProjectDir('unimportant');
        $buildConfiguration->setProjectDir('unimportant');
    }
}
