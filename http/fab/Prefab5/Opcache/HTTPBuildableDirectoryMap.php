<?php


namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\ComposerFileParser;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\Exception;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\RouteMapBuilder;
use Symfony\Component\Yaml\Yaml;

class HTTPBuildableDirectoryMap implements HTTPBuildableDirectoryMapInterface
{
    protected const BUILDABLE_DIRECTORY_MAP_KEY = 'buildable-directory-map-key';
    protected const COMPOSER_FILE_PATH = __DIR__ . '/../../../composer.json';
    protected const ROUTE_FILE_PATH = __DIR__ . '/../Zend/Expressive/Application/Decorator.service.yml';


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

    public function getDirectoryMap() : array
    {
        if ($this->directoryMap === null) {
            $directoryMap = $this->get();
            if ($directoryMap === false) {
                $this->directoryMap = $this->buildDirectoryMap();
                $this->set(self::BUILDABLE_DIRECTORY_MAP_KEY, json_encode($this->directoryMap));
            } else {
                $this->directoryMap = json_decode($directoryMap, true);
            }
        }

        return $this->directoryMap;
    }

    protected function buildDirectoryMap() : array
    {
       $namespace = (new ComposerFileParser())
           ->setComposerFilePath(self::COMPOSER_FILE_PATH)
            ->getPsr4AutoloaderBaseNamespace();

        $directoryMap = (new RouteMapBuilder())
            ->setRouteFilePath(self::ROUTE_FILE_PATH)
            ->setNamespace($namespace)
            ->buildRouteMap();

        return $directoryMap;
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
