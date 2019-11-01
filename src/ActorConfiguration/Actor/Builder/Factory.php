<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Builder;

interface Factory
{
    public const ACTOR_KEY = '<ActorName>/Builder/Factory.php';
    public const TEMPLATE_PATH = 'Actor/Builder/Factory.php';
    public const ANNOTATION_PROCESSORS = [];
}
