<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\ErrorHandler;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\ErrorHandlerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler;

    public function setPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler(ErrorHandlerInterface $prefab5OpcacheHTTPBuildableDirectoryMapErrorHandler) : self
    {
        if ($this->hasPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler = $prefab5OpcacheHTTPBuildableDirectoryMapErrorHandler;

        return $this;
    }

    protected function getPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler() : ErrorHandlerInterface
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler;
    }

    protected function hasPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler);
    }

    protected function unsetPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler() : self
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMapErrorHandler);

        return $this;
    }
}
