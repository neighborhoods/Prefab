<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;


class StringReplacer implements StringReplacerInterface
{
    /** @example Neighborhoods\MyService\MV1\MyDao\Factory */
    protected $namespace;
    protected $file;

    /**
     * Fully namespaced DAO name
     * @example Neighborhoods\MyService\MV1\MyDao
     */
    protected const DAO_NAME_PLACEHOLDER = 'DAONAMEPLACEHOLDER';
    /**
     * Camel cased namespace
     * @example NeighborhoodsMyServiceMV1MyDao
     */
    protected const DAO_VAR_NAME_PLACEHOLDER = 'DAOVARNAMEPLACEHOLDER';
    /**
     * Name of the project
     * @example MyService
     */
    protected const PROJECT_NAME_PLACEHOLDER = 'PROJECTNAMEPLACEHOLDER';
    /**
     * Non-namespaced DAO name
     * @example MyDao
     */
    protected const TRUNCATED_DAO_NAME_PLACEHOLDER = 'TRUNCATEDDAONAMEPLACEHOLDER';
    /**
     * Namespace
     * @example Neighborhoods\MyService\MV1\MyDao\Factory
     */
    protected const NAMESPACE_PLACEHOLDER = 'NAMESPACEPLACEHOLDER';

    protected $placeholdersToReplace = [];

    public function replacePlaceholders() : string
    {
        $this->setPlaceholderValues();

        return str_replace(
            array_keys($this->placeholdersToReplace),
            array_values($this->placeholdersToReplace),
            $this->getFile()
        );
    }

    protected function setPlaceholderValues()
    {
        $this->placeholdersToReplace[self::TRUNCATED_DAO_NAME_PLACEHOLDER] = $this->getTruncatedDaoName();
        $this->placeholdersToReplace[self::DAO_NAME_PLACEHOLDER] = $this->getDaoName();
        $this->placeholdersToReplace[self::DAO_VAR_NAME_PLACEHOLDER] = $this->getDaoVarName();
        $this->placeholdersToReplace[self::PROJECT_NAME_PLACEHOLDER] = $this->getProjectName();
        $this->placeholdersToReplace[self::NAMESPACE_PLACEHOLDER] = $this->getNamespace();

    }

    protected function getDaoName() : string
    {
        return $this->getNamespace();
    }

    protected function getDaoVarName() : string
    {

        return implode('', explode('\\', $this->getNamespace()));
    }

    protected function getProjectName() : string
    {
        return explode('\\', $this->getNamespace())[1];
    }

    protected function getTruncatedDaoName() : string
    {
        $namespaceArray = explode('\\', $this->getNamespace());
        return $namespaceArray[count($namespaceArray) - 1];
    }

    protected function getFile() : string
    {
        if ($this->file === null) {
            throw new \LogicException('StringReplacer file has not been set.');
        }
        return $this->file;
    }

    public function setFile(string $file) : StringReplacerInterface
    {
        if ($this->file !== null) {
            throw new \LogicException('StringReplacer file is already set.');
        }
        $this->file = $file;
        return $this;
    }

    public function getNamespace() : string
    {
        if ($this->namespace === null) {
            throw new \LogicException('StringReplacer namespace has not been set.');
        }
        return $this->namespace;
    }

    public function setNamespace(string $namespace) : StringReplacerInterface
    {
        if ($this->namespace !== null) {
            throw new \LogicException('StringReplacer namespace is already set.');
        }
        $this->namespace = $namespace;
        return $this;
    }
}
