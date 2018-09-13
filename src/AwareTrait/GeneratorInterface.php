<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait;

use Symfony\Component\Finder\SplFileInfo;

interface GeneratorInterface
{
    public function generate(SplFileInfo $dao);
}
