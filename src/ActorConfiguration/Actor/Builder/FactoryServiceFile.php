<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Builder;

interface FactoryServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Builder/Factory.service.yml';
    public const TEMPLATE_PATH = 'Actor/Builder/Factory.service.yml';
    public const STATIC_CONTEXT_RECORD_BUILDERS = [];
}
