<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


use Neighborhoods\Prefab\Bradfab\Template;

class AwareTraitActor implements AwareTraitActorInterface
{
    public function getActorConfiguration() : array
    {
        return [Template::KEY_ACTOR_KEY_PREFIX . self::ACTOR_KEY => null];
    }
}
