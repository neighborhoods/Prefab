<?php


namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\Exception;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis\Map;
use Symfony\Component\Yaml\Yaml;

class HTTPBuildableDirectoryMap implements HTTPBuildableDirectoryMapInterface
{
    protected const BUILDABLE_DIRECTORY_FILEPATH = __DIR__ . '/../../..';
    protected const BUILDABLE_DIRECTORY_FILENAME = 'http-buildable-directories.yml';
    protected const CODE_FILE_NOT_FOUND = 'code_file_not_found';

    protected $directoryMap;

    protected function set(string $value) : HTTPBuildableDirectoryMapInterface
    {
        $temporaryFileName = $this->getCacheFilePath();

        try {
            if (file_put_contents($temporaryFileName, '<?php $value = ' . var_export($value, true) . ';') === false) {
                throw (new Exception())->setCode(Exception::CODE_FAILED_TO_WRITE_FILE);
            }
        } catch (Exception $exception) {
            (new NewRelic())->noticeThrowable($exception);
        }

        return $this;
    }

    protected function get()
    {
        if (file_exists($this->getCacheFilePath())) {
            include $this->getCacheFilePath();
        }

        return $value ?? false;
    }

    public function flush() : HTTPBuildableDirectoryMapInterface
    {
        opcache_invalidate($this->getCacheFilePath(), true);
        unlink($this->getCacheFilePath());

        return $this;
    }

    public function getBuildableDirectoryMap() : array
    {

        if ($this->directoryMap !== null) {
            return $this->directoryMap;
        }

        $directoryMap = $this->get();

        // This code is set after the file is not found the first time to prevent disk access on every subsequent call
        if ($directoryMap === self::CODE_FILE_NOT_FOUND) {
            throw (new BuildableDirectoryFileNotFound\Exception())->setCode(BuildableDirectoryFileNotFound\Exception::CODE_FILE_NOT_FOUND);
        }

        if ($directoryMap !== false) {
            $this->directoryMap = $directoryMap;
            return $this->directoryMap;
        }

        $filepath = self::BUILDABLE_DIRECTORY_FILEPATH . '/' . self::BUILDABLE_DIRECTORY_FILENAME;

        if (!file_exists($filepath)) {
            $this->set(self::CODE_FILE_NOT_FOUND);
            throw (new BuildableDirectoryFileNotFound\Exception())->setCode(BuildableDirectoryFileNotFound\Exception::CODE_FILE_NOT_FOUND);
        }

        $directoryMap = Yaml::parseFile($filepath);

        if ($directoryMap === false) {
            throw (new Exception())->setCode(Exception::CODE_INVALID_YAML_FILE);
        }

        $this->directoryMap = $directoryMap;
        $this->set($this->directoryMap);

        return $this->directoryMap;
    }

    protected function getCacheDirectoryPath() : string
    {
        return self::CACHE_DIRECTORY_PATH;
    }

    protected function getCacheFilePath()
    {
        return sprintf('%s/%s.php', $this->getCacheDirectoryPath(), HTTPBuildableDirectoryMap::class);
    }
}
