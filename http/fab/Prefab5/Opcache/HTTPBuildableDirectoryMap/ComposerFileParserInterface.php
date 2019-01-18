<?php


namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;


interface ComposerFileParserInterface
{
    public function getPsr4AutoloaderBaseNamespace() : string;

    public function setComposerFilePath(string $composerFilePath) : ComposerFileParserInterface;
}
