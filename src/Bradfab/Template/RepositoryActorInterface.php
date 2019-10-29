<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

interface RepositoryActorInterface
{
    public const REPOSITORY_KEY = 'Map\Repository';

    public const REPOSITORY_ACTOR_KEY = 'Map\Repository.php';
    public const REPOSITORY_INTERFACE_ACTOR_KEY = 'Map\RepositoryInterface.php';
    public const REPOSITORY_SERVICE_FILE_ACTOR_KEY = 'Map\Repository.service.yml';

    public function getActorConfiguration() : array;

    public function setProjectName($project_name) : RepositoryActorInterface;

    public function setProperties(array $properties) : RepositoryActorInterface;

    public function setIdentityField(string $identity_field) : RepositoryActorInterface;
}
