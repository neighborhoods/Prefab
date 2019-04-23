<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class AwareTraitActor
{
    public const ACTOR_KEY = 'AwareTrait.php';

    public function getActorConfiguration() : ?array
    {
        return [self::ACTOR_KEY => null];
    }
}
