<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

class ComposerFileParser implements ComposerFileParserInterface
{
    /** @var string */
    protected $composerFilePath;

    public function getPsr4AutoloaderBaseNamespace() : string
    {
        if (!file_exists($this->getComposerFilePath())) {
            throw (new Exception())->setCode(Exception::CODE_COMPOSER_FILE_NOT_FOUND);

        }

        $composerFile = file_get_contents($this->getComposerFilePath());

        $composerArray = json_decode($composerFile, true);

        if ($composerArray === null) {
            throw (new Exception())->setCode(Exception::CODE_COMPOSER_FILE_INVALID_JSON);
        }

        return array_keys($composerArray['autoload']['psr-4'])[0];
    }

    protected function getComposerFilePath() : string
    {
        if ($this->composerFilePath === null) {
            throw new \LogicException('ComposerFileParser composerFilePath has not been set.');
        }
        return $this->composerFilePath;
    }

    public function setComposerFilePath(string $composerFilePath) : ComposerFileParserInterface
    {
        if ($this->composerFilePath !== null) {
            throw new \LogicException('ComposerFileParser composerFilePath is already set.');
        }
        $this->composerFilePath = $composerFilePath;
        return $this;
    }
}
