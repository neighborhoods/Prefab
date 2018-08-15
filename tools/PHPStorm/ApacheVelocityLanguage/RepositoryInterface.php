#set($namespacePrefix = "")
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#set($daoUpper = "")
#set($daoLower = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use ${namespacePrefix}SearchCriteriaInterface;

interface RepositoryInterface
{
    public function createBuilder(): BuilderInterface;

    public function save(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface;

    public function attach(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface;

    public function detach(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface;

    public function getMap(SearchCrtieriaInterface ${DS}searchCriteria): MapInterface;
}
