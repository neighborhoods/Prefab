#set($namespacePrefix = "")
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#set($daoUpper = "")
#set($daoLower = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use ${NAMESPACE}Interface;
use ${namespacePrefix}SearchCriteriaInterface;

interface RepositoryInterface
{
    public function createBuilder(): BuilderInterface;

    public function get(SearchCriteriaInterface ${DS}searchCriteria): MapInterface;
    
    public function save(MapInterface ${DS}map): RepositoryInterface;
}
