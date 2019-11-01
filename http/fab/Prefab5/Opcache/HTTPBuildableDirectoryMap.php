<?php


namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\Exception;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
use Symfony\Component\Yaml\Yaml;

class HTTPBuildableDirectoryMap implements HTTPBuildableDirectoryMapInterface
{
    protected const BUILDABLE_DIRECTORY_FILEPATH = __DIR__ . '/../../..';
    protected const BUILDABLE_DIRECTORY_FILENAME = 'http-buildable-directories.yml';
    protected const CODE_FILE_NOT_FOUND = 'code_file_not_found';

    protected const LOG_FILE_PATH = __DIR__ . '/../../../Logs/HTTP.log';

    protected $directoryMap;

    protected function set(string $value) : HTTPBuildableDirectoryMapInterface
    {
        try {
            $this->saveValueToTempFile($value);
        } catch (Exception $exception) {
            $newRelic = new NewRelic();

            if ($newRelic->isExtensionLoaded()) {
                $newRelic->noticeThrowable($exception);
            } else if (getenv('SITE_ENVIRONMENT') === 'Local') {
                (new Logger())
                    ->setLogFilePath(self::LOG_FILE_PATH)
                    ->notice($exception->__toString());
            }
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

    public function getBuildableDirectoryMap() : ?array
    {

        if ($this->directoryMap !== null) {
            return $this->directoryMap;
        }

        $directoryMap = $this->get();

        // This code is set after the file is not found the first time to prevent
        // disk access on every subsequent call
        if ($directoryMap === self::CODE_FILE_NOT_FOUND) {
            return null;
        }

        if ($directoryMap !== false) {
            $this->directoryMap = json_decode($directoryMap, true);
            return $this->directoryMap;
        }

        $filepath = self::BUILDABLE_DIRECTORY_FILEPATH . '/' . self::BUILDABLE_DIRECTORY_FILENAME;

        if (!file_exists($filepath)) {
            $this->set(self::CODE_FILE_NOT_FOUND);
            return null;
        }

        $directoryMap = Yaml::parseFile($filepath);

        if ($directoryMap === false) {
            throw (new Exception())->setCode(Exception::CODE_INVALID_YAML_FILE);
        }

        $this->directoryMap = $directoryMap;
        $this->set(json_encode($this->directoryMap));

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

    protected function saveValueToTempFile(string $value) : void
    {
        $fileDidSave = file_put_contents(
            $this->getCacheFilePath(),
            '<?php $value = ' . var_export($value, true) . ';'
        );

        if ($fileDidSave === false) {
            throw (new Exception())
                ->setCode(Exception::CODE_FAILED_TO_WRITE_FILE);
        }
    }
}
