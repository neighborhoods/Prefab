<?php

namespace Neighborhoods\Prefab\BuildPlan;



class Builder implements BuilderInterface
{
    protected function assembleBuildPlan() : BuilderInterface
    {
        $finder = new Finder();
        $daos = $finder->files()->name('*.dao.yml')->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $daoProperties = Yaml::parseFile($dao->getPath() . '/' . $dao->getFilename());

            $daoFilePath = $this->fabLocation . self::FORWARD_SLASH . $dao->getRelativePath();
            $namespacePrefix = 'Neighborhoods\\' . $this->getProjectName() . '\\';
            $trimmedFileName = str_replace('.dao.yml', '', $dao->getRelativePathname());
            $daoNamespace = $namespacePrefix . str_replace('/', '\\', $trimmedFileName);
            $daoMeta = $this->getConsoleGeneratorMetaFactory()->create();

            $daoMeta->setDaoName($daoProperties['dao']['dao_name']);
            $daoMeta->setActorNamespace($daoNamespace);
            $daoMeta->setActorFilePath($daoFilePath);
            $daoMeta->setDaoProperties($daoProperties);

            $this->addDaoToPlan($daoMeta);
        }

        return $this;
    }
}
