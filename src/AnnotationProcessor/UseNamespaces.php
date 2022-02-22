<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\Context;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class UseNamespaces implements AnnotationProcessorInterface
{
    public const CONTEXT_KEY_USES = 'uses';

    private const FORMAT_USE = 'use %s;';

    use Context\AwareTrait {
        getAnnotationProcessorContext as public;
    }

    public function getReplacement(): string
    {
        $context = $this->getAnnotationProcessorContext()->getStaticContextRecord();

        return implode(
            PHP_EOL,
            array_map(
                static function (string $namespace): string {
                    return sprintf(self::FORMAT_USE, $namespace);
                },
                $context[self::CONTEXT_KEY_USES]
            )
        );
    }
}
