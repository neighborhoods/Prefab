<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

interface ActorServiceFile
{
    public const ACTOR_KEY = '<ActorName>.service.yml';
    public const TEMPLATE_PATH = 'Actor.service.yml';
    public const ANNOTATION_PROCESSORS = [];
}
