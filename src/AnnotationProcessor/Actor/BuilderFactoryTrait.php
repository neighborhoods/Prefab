<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class BuilderFactoryTrait implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-AwareTraits';

    protected const NEIGHBORHOODS_NAMESPACE = '\\Neighborhoods\\';

    protected const COMPLEX_OBJECT_BUILDER_METHOD = <<< EOF
    \$Actor->set%s(
            \$this->get%sBuilderFactory()->create()->setRecord(\$record[ActorInterface::PROP_%s])->build()
    );
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
        $properties = $this->getAnnotationProcessorContext()->getStaticContextRecord()['properties'];

        $replacement = '';

        $builtTraits = [];
        foreach ($properties as $propertyName => $property) {

            if ($this->isPropertyComplexObject($property['data_type']) && ! in_array($property['data_type'], $builtTraits)) {
                $dataType = str_replace('Interface', '', $property['data_type']);
                $replacement .= "\tuse " . $dataType . '\\Builder\\Factory\\AwareTrait;' . PHP_EOL;
                $builtTraits[] = $property['data_type'];
            }
        }

        return $replacement;
    }

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type, self::NEIGHBORHOODS_NAMESPACE) === 0;
    }
}
