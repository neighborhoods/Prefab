<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit;

use Neighborhoods\Prefab\ClassSaver;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class ClassSaverTest extends TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $filesystem;

    protected function setUp()
    {
        parent::setUp();

        $this->filesystem = vfsStream::setup();
    }

    /**
     * @test
     */
    public function shouldReturnSelfWhenSettingGeneratedClass(): void
    {
        $classSaver = new ClassSaver();

        $this->assertSame(
            $classSaver,
            $classSaver->setGeneratedClass('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingGeneratedClassMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver generatedClass is already set.'
        );

        $classSaver = new ClassSaver();

        $classSaver->setGeneratedClass('unimportant');
        $classSaver->setGeneratedClass('unimportant');
    }

    /**
     * @test
     */
    public function shouldThrowWhenAttemptingToGetUndefinedSavePath(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver savePath has not been set.'
        );

        $classSaver = new ClassSaver();

        $classSaver->getSavePath();
    }

    /**
     * @test
     */
    public function shouldGetSavePath(): void
    {
        $expectedSavePath = 'some save path';

        $classSaver = new ClassSaver();

        $classSaver->setSavePath($expectedSavePath);

        $this->assertSame(
            $expectedSavePath,
            $classSaver->getSavePath()
        );
    }

    /**
     * @test
     */
    public function shouldReturnSelfWhenSettingSavePath(): void
    {
        $classSaver = new ClassSaver();

        $this->assertSame(
            $classSaver,
            $classSaver->setSavePath('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingSavePathMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver savePath is already set.'
        );

        $classSaver = new ClassSaver();

        $classSaver->setSavePath('unimportant');
        $classSaver->setSavePath('unimportant');
    }

    /**
     * @test
     */
    public function shouldReturnSelfWhenSettingClassName(): void
    {
        $classSaver = new ClassSaver();

        $this->assertSame(
            $classSaver,
            $classSaver->setClassName('unimportant')
        );
    }

    /**
     * @test
     */
    public function shouldPreventSettingClassNameMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver className is already set.'
        );

        $classSaver = new ClassSaver();

        $classSaver->setClassName('unimportant');
        $classSaver->setClassName('unimportant');
    }

    /**
     * @test
     */
    public function shouldWriteClassToSpecifiedPath(): void
    {
        $expectedClassName = 'SomeClass';
        $expectedSavePath = $this->filesystem->url() . '/saved-class-destination';
        $expectedPathToSavedClass = $expectedSavePath . '/' . $expectedClassName . '.php';
        $expectedClassContents = <<<EOF
<?php

class SomeClass
{
    public function doStuff(): void
    {
        echo 'Hello world!';
    }
}

EOF;

        $classSaver = new ClassSaver();

        $classSaver->setSavePath($expectedSavePath);
        $classSaver->setClassName($expectedClassName);
        $classSaver->setGeneratedClass($expectedClassContents);
        $classSaver->saveClass();

        $savedClass = file_get_contents($expectedPathToSavedClass);

        $this->assertSame(
            $expectedClassContents,
            $savedClass
        );
    }

    /**
     * @test
     */
    public function shouldCreateSavePathDirIfItDoesNotExistYet(): void
    {
        $expectedDirectory = $this->filesystem->url() . '/new-dir';

        $classSaver = new ClassSaver();
        $classSaver->setSavePath($expectedDirectory);
        $classSaver->setClassName('Unimportant');
        $classSaver->setGeneratedClass('unimportant');

        $this->assertDirectoryNotExists(
            $expectedDirectory
        );

        $classSaver->saveClass();

        $this->assertDirectoryExists(
            $expectedDirectory
        );

        $this->assertSame(
            '0777',
            substr(sprintf('%o', fileperms($expectedDirectory)), -4)
        );
    }

    /**
     * @test
     */
    public function shouldThrowIfSavingClassWithoutNamingItFirst(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver className has not been set.'
        );

        $classSaver = new ClassSaver();
        $classSaver->setSavePath($this->filesystem->url());
        $classSaver->setGeneratedClass('unimportant');
        $classSaver->saveClass();
    }

    /**
     * @test
     */
    public function shouldThrowIfSavingClassWithoutSpecifyingSavePathFirst(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver savePath has not been set.'
        );

        $classSaver = new ClassSaver();
        $classSaver->setClassName('Unimportant');
        $classSaver->setGeneratedClass('unimportant');
        $classSaver->saveClass();
    }

    /**
     * @test
     */
    public function shouldThrowIfSavingClassWithoutProvidingClassFileContents(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'ClassSaver generatedClass has not been set.'
        );

        $classSaver = new ClassSaver();
        $classSaver->setClassName('Unimportant');
        $classSaver->setSavePath($this->filesystem->url());
        $classSaver->saveClass();
    }
}
