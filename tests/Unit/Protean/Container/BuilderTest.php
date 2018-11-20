<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Protean\Container;

/**
 * Stub of global function for testing in-memory filesystem
 *
 * vfsStream doesn't support calling `realpath` on a virtual filesystem, so we
 * can stub this function to be a pass-through.
 *
 * @param string $path
 * @return string
 */
function realpath($path)
{
    return $path;
}

namespace Neighborhoods\PrefabTest\Unit\Protean\Container;

use Neighborhoods\Prefab\Protean\Container\Builder;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $filesystem;

    /**
     * @var string
     */
    private $filesystemRoot;

    protected function setUp()
    {
        parent::setUp();

        $this->filesystem = vfsStream::setup();
        $this->filesystemRoot = $this->filesystem->url() . '/';
    }

    /**
     * @test
     */
    public function shouldThrowWhenProvidedAppRootIsNotDirectory(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $filename = 'some-file.txt';

        $invalidAppRoot = $this->filesystemRoot . $filename;

        touch($invalidAppRoot);

        $builder = new Builder();

        $builder->setApplicationRootDirectoryPath($invalidAppRoot);
    }

    /**
     * @test
     */
    public function shouldThrowWhenAppRootNotSetBeforeBuild(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'Application root directory path is not set.'
        );

        $builder = new Builder();

        $builder->build();
    }

    /**
     * @test
     */
    public function shouldThrowWhenAppRootAlreadySet(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'Application root directory path is already set.'
        );

        $validDirName = $this->filesystemRoot . 'some-dir';

        mkdir($validDirName);

        $builder = new Builder();

        $builder->setApplicationRootDirectoryPath($validDirName);
        $builder->setApplicationRootDirectoryPath('/root/some-other-dir');
    }

    /**
     * @test
     */
    public function shouldBuildWithoutErrorWhenProvidedValidAppDirectory(): void
    {
        $appRoot = $this->filesystemRoot . 'my-app';

        mkdir($appRoot);
        mkdir($appRoot . '/fab');
        mkdir($appRoot . '/src');

        $builder = new Builder();

        $builder->setApplicationRootDirectoryPath($appRoot);

        $builder->build();

        // If the above code evaluates without throwing an exception, we can
        // consider this test as passing.
        $this->addToAssertionCount(1);
    }
}
