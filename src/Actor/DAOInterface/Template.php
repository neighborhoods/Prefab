<?php
declare(strict_types=1);

namespace NAMESPACEPLACEHOLDER;

interface TRUNCTATEDDAONAMEPLACEHOLDERInterface extends \JsonSerializable
{
    public const TABLE_NAME = 'TABLENAMEPLACEHOLDER';
    public const FIELD_IDENTITY = 'FIELDIDENTITYPLACEHOLDER';

    DATABASEPROPERTIESPLACEHOLDER
    public const PROP_ID = 'id';
    public const PROP_KEY = 'key';

    INTERFACEMETHODSPLACEHOLDER
    public function getId(): int;

    public function setId(int $id): UserInterface;

}
