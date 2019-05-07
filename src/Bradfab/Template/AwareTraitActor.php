<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class AwareTraitActor implements AwareTraitActorInterface
{
    public function getActorConfiguration() : array
    {
        return [self::ACTOR_KEY => null];
    }
}
