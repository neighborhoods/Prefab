<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

interface FactoryServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Factory.service.yml';
    public const TEMPLATE_PATH = 'Actor/Factory.service.yml';
    public const STATIC_CONTEXT_RECORD_BUILDERS = [];
}
