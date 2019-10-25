<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

interface Factory
{
    public const ACTOR_KEY = '<ActorName>/Factory.php';
    public const TEMPLATE_PATH = 'Actor/Factory.php';
    public const ANNOTATION_PROCESSORS = [];
}
