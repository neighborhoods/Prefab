<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface AwareTraitActorInterface
{
    public const ACTOR_KEY = 'AwareTrait.php';

    public function getActorConfiguration() : array;
}
