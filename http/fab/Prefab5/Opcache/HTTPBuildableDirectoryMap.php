<?php


namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\Exception;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use Symfony\Component\Yaml\Yaml;

class HTTPBuildableDirectoryMap implements HTTPBuildableDirectoryMapInterface
{
    protected const BUILDABLE_DIRECTORY_MAP_KEY = 'buildable-directory-map-key';
    protected const BUILDABLE_DIRECTORY_FILEPATH = __DIR__ . '/../../../';
    protected const BUILDABLE_DIRECTORY_FILENAME = 'http-buildable-directories.yml';


    protected $directoryMap;

    protected function set(string $key, string $value) : HTTPBuildableDirectoryMapInterface
    {
        $temporaryFileName = $this->getCacheDirectoryPath() . '/' . $key . uniqid('', true) . '.tmp';
        try {
            if (file_put_contents($temporaryFileName, '<?php $value = ' . var_export($value, true) . ';') === false) {
                throw (new Exception())->setCode(Exception::CODE_FILE_PUT_CONTENTS_FAILED);
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
        if ($this->directoryMap === null) {
            $directoryMap = $this->get();
            if ($directoryMap === false) {
                $filepath = self::BUILDABLE_DIRECTORY_FILEPATH . '/' . self::BUILDABLE_DIRECTORY_FILENAME;
                if (file_exists($filepath)) {
                    $this->directoryMap = Yaml::parseFile($filepath);
                    $this->set(self::BUILDABLE_DIRECTORY_MAP_KEY, json_encode($this->directoryMap));
                } else {
                    throw (new Exception())->setCode(Exception::CODE_BUILDABLE_DIRECTORY_FILE_NOT_FOUND);
                }
            } else {
                $this->directoryMap = json_decode($directoryMap, true);
            }
        }

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
