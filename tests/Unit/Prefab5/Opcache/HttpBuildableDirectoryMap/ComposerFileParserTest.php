<?php

namespace Neighborhoods\PrefabTest\Prefab5\Opcache\HttpBuildableDirectoryMap;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\ComposerFileParser;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class ComposerFileParserTest extends TestCase
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
    public function shouldSetComposerFilePath() : void
    {
        $parser = new ComposerFileParser();

        $parser->setComposerFilePath('unimportant');

        static::assertInstanceOf(
            ComposerFileParser::class,
            $parser
        );
    }

    /**
     * @test
     */
    public function shouldPreventMutatingComposerFilePath() : void
    {
        static::expectException(\LogicException::class);

        $parser = new ComposerFileParser();

        $parser->setComposerFilePath('unimportant');
        $parser->setComposerFilePath('unimportant');
    }

    /**
     * @test
     */
    public function shouldParsePsr4AutoloaderNamespaceFromComposerJsonFile() : void
    {
        $expectedNamespace = 'Neighborhoods\\SomeProject\\';

        $parser = new ComposerFileParser();

        $composerJsonFile = <<<EOF
{
   "autoload": {
      "psr-4": {
         "Neighborhoods\\\\SomeProject\\\\": [
            "src"
          ]
      }
    }
}
EOF;

        file_put_contents($this->filesystem->url() . '/composer.json', $composerJsonFile);

        $parser->setComposerFilePath($this->filesystem->url() . '/composer.json');
        $namespace = $parser->getPsr4AutoloaderBaseNamespace();

        static::assertSame(
            $expectedNamespace,
            $namespace
        );
    }

    /**
     * @test
     */
    public function shouldThrowComposerFileNotFoundException() : void
    {
        self::expectException(HTTPBuildableDirectoryMap\Exception::class);
        self::expectExceptionCode(HTTPBuildableDirectoryMap\Exception::CODE_COMPOSER_FILE_NOT_FOUND);

        $parser = new ComposerFileParser();

        $parser->setComposerFilePath('/somepath/composer.json');
        $parser->getPsr4AutoloaderBaseNamespace();
    }

    /**
     * @test
     */
    public function shouldThrowInvalidJsonException() : void
    {
        self::expectException(HTTPBuildableDirectoryMap\Exception::class);
        self::expectExceptionCode(HTTPBuildableDirectoryMap\Exception::CODE_COMPOSER_FILE_INVALID_JSON);
        $parser = new ComposerFileParser();
        $composerJsonFile = <<<EOF
{
   "autoload": {
      "psr-4": {
         "Neighborhoods\\\\SomeProject\\\\": [
            "src"
          ]
      }
    }
hey who forgot to close this curly brace
EOF;

        file_put_contents($this->filesystem->url() . '/composer.json', $composerJsonFile);

        $parser->setComposerFilePath($this->filesystem->url() . '/composer.json');
        $parser->getPsr4AutoloaderBaseNamespace();

    }
}
