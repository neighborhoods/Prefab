<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ClassSaver;

use Neighborhoods\Prefab\ClassSaverInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): ClassSaverInterface;
}
