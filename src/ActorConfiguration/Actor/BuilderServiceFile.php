<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

interface BuilderServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Builder.service.yml';
    public const TEMPLATE_PATH = 'Actor/Builder.service.yml';
    public const STATIC_CONTEXT_RECORD_BUILDERS = [];
}
