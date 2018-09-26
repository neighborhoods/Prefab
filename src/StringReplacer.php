<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;


class StringReplacer implements StringReplacerInterface
{
    /**
     * All below examples are based on the following namespace
     * @example Neighborhoods\MyService\MV1\MyDao\Factory
     */
    protected $namespace;
    protected $file;

    /**
     * Fully namespaced DAO name
     * @example Neighborhoods\MyService\MV1\MyDao
     */
    protected const DAO_NAME_PLACEHOLDER = 'DAONAMEPLACEHOLDER';
    /**
     * Camel cased namespace. `Neighborhoods` and `Project Name` are truncated from the beginning
     * @example MV1MyDao
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

    /**
     * Parent namespace
     * @example Neighborhoods\MyService\MV1\MyDao
     */
    protected const PARENT_NAMESPACE_PLACEHOLDER = 'PARENTNAMESPACEPLACEHOLDER';

    /**
     * Parent name without leading namespace
     * @example MyDao
     */
    protected const TRUNCATED_PARENT_NAMESPACE_PLACEHOLDER = 'TRUNCATEDPARENTNAMESPACEPLACEHOLDER';

    /**
     * Uppercase parent name without leading namespace
     * @example MYDAO
     */
    protected const UC_TRUNCATED_PARENT_NAMESPACE_PLACEHOLDER = 'UCTRUNCATEDPARENTNAMESPACEPLACEHOLDER';

    protected $placeholdersToReplace = [];

    public function replacePlaceholders() : string
    {
        $this->setPlaceholderValues();

        // Sort keys from longest to shortest to ensure something like NAMESPACEPLACEHOLDER doesn't replace
        // TRUNCATEDNAMESPACEPLACEHOLDER
        $keys = array_map('strlen', array_keys($this->placeholdersToReplace));
        array_multisort($keys, SORT_DESC, $this->placeholdersToReplace);

        return str_replace(
            array_keys($this->placeholdersToReplace),
            array_values($this->placeholdersToReplace),
            $this->getFile()
        );
    }

    protected function setPlaceholderValues()
    {
        $this->placeholdersToReplace[self::PARENT_NAMESPACE_PLACEHOLDER] = $this->getParentNamespace();
        $this->placeholdersToReplace[self::TRUNCATED_DAO_NAME_PLACEHOLDER] = $this->getTruncatedDaoName();
        $this->placeholdersToReplace[self::DAO_NAME_PLACEHOLDER] = $this->getDaoName();
        $this->placeholdersToReplace[self::DAO_VAR_NAME_PLACEHOLDER] = $this->getDaoVarName();
        $this->placeholdersToReplace[self::PROJECT_NAME_PLACEHOLDER] = $this->getProjectName();
        $this->placeholdersToReplace[self::NAMESPACE_PLACEHOLDER] = $this->getNamespace();
        $this->placeholdersToReplace[self::TRUNCATED_PARENT_NAMESPACE_PLACEHOLDER] = $this->getTruncatedParentNamespace();
        $this->placeholdersToReplace[self::UC_TRUNCATED_PARENT_NAMESPACE_PLACEHOLDER] = $this->getUcTruncatedParentNamespace();
    }

    protected function getUcTruncatedParentNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getNamespace());
        return strtoupper($namespaceArray[count($namespaceArray) - 2]);

    }
    protected function getTruncatedParentNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getNamespace());
        return $namespaceArray[count($namespaceArray) - 2];
    }
    protected function getDaoName() : string
    {
        return $this->getNamespace();
    }

    protected function getDaoVarName() : string
    {
        $namespaceArray =  explode('\\', $this->getNamespace());
        unset($namespaceArray[0]);
        unset($namespaceArray[1]);
        return implode('', $namespaceArray);
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

    protected function getParentNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getNamespace());
        unset($namespaceArray[count($namespaceArray) - 1]);
        return implode('\\', $namespaceArray);
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
