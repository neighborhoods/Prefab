<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class HandlerInterface implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface-CONSTANTS';

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
        $path = $this->getAnnotationProcessorContext()->getStaticContextRecord()['route_path'];
        $name = $this->getAnnotationProcessorContext()->getStaticContextRecord()['route_name'];
        $name = strtoupper($name);

        return sprintf(self::ROUTE_PATH_LINE_FORMAT_STRING, $name, $path, $name, $name);
    }
}
