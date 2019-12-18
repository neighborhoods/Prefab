<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

interface ActorServiceFile
{
    public const ACTOR_KEY = '<PrimaryActorName>/<PrimaryActorName>.service.yml';
    public const TEMPLATE_PATH = 'PrimaryActorName/PrimaryActorName.service.yml';
    public const ANNOTATION_PROCESSORS = [];
}
