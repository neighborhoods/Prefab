<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface BuildConfigurationInterface
{
    public const PREFAB_DEFINITION_FILE_EXTENSION = '.prefab.definition.yml';

    public const SUPPORTING_ACTOR_GROUP_COMPLETE = 'complete';
    public const SUPPORTING_ACTOR_GROUP_COLLECTION = 'collection';
    public const SUPPORTING_ACTOR_GROUP_MINIMAL = 'minimal';

    public const KEY_DAO = 'dao';
    public const KEY_TABLE_NAME = 'table_name';
    public const KEY_NAME = 'name';
    public const KEY_IDENTITY_FIELD = 'identity_field';
    public const KEY_HTTP_ROUTE = 'http_route';
    public const KEY_HTTP_VERBS = 'http_verbs';
    public const HTTP_VERB_GET = 'GET';
    public const KEY_SUPPORTING_ACTOR_GROUP = 'supporting_actor_group';
    public const KEY_PROPERTIES = 'properties';

    public function getTableName() : string;

    public function setTableName(string $tableName) : BuildConfigurationInterface;

    public function getDaoIdentityField() : string;

    public function setDaoIdentityField(string $daoIdentityField) : BuildConfigurationInterface;

    public function hasDaoIdentityField() : bool;

    public function getDaoProperties() : array;

    public function appendDaoProperty(DaoPropertyInterface $daoProperty) : BuildConfigurationInterface;

    public function getRootSaveLocation() : string;

    public function setRootSaveLocation(string $projectDirectory) : BuildConfigurationInterface;

    public function getProjectName() : string;

    public function setProjectName(string $projectName) : BuildConfigurationInterface;

    public function getHttpRoute() : string;

    public function setHttpRoute(string $httpRoute) : BuildConfigurationInterface;

    public function hasHttpRoute() : bool;

    public function getHttpVerbs() : array;

    public function setHttpVerbs(array $httpVerbs) : BuildConfigurationInterface;

    public function hasHttpVerbs() : bool;

    public function setProjectDir(string $projectDir) : BuildConfigurationInterface;

    public function getProjectDir() : string;

    public function setSupportingActorGroup(string $supporting_actor_group) : BuildConfigurationInterface;

    public function getSupportingActorGroup() : string;

    public function hasSupportingActorGroup() : bool;

    public function getDaoName() : string;

    public function setDaoName(string $daoName) : BuildConfigurationInterface;

    public function hasDaoName() : bool;

    public function getActorNamespace() : string;

    public function setActorNamespace(string $actorNamespace) : BuildConfigurationInterface;

    public function hasActorNamespace() : bool;
}
