<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class HandlerInterface implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerInterface-CONSTANTS';
    public const CONTEXT_KEY_ROUTE_PATH = 'route_path';
    public const CONTEXT_KEY_ROUTE_NAME = 'route_name';

    protected $context;

    protected const ROUTE_PATH_LINE_FORMAT_STRING =
        <<<EOF
    const ROUTE_PATH_%sS = '%s';
    const ROUTE_NAME_%sS = '%s';
EOF;

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('Handler context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Handler context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $path = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::CONTEXT_KEY_ROUTE_PATH];
        $name = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::CONTEXT_KEY_ROUTE_NAME];
        $name = strtoupper($name);

        return sprintf(self::ROUTE_PATH_LINE_FORMAT_STRING, $name, $path, $name, $name);
    }
}
