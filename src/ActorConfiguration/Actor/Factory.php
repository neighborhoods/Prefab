<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

interface Factory
{
    public const ACTOR_KEY = '<PrimaryActorName>/Factory.php';
    public const TEMPLATE_PATH = 'PrimaryActorName/Factory.php';
    public const ANNOTATION_PROCESSORS = [];
}
