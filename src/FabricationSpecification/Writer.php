<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;
use Symfony\Component\Yaml\Yaml;

class Writer implements WriterInterface
{
    protected const KEY_ACTORS = 'actors';
    protected const KEY_TEMPLATE = 'template';

    protected $fabricationSpecification;
    protected $writePath;

    public function write() : WriterInterface
    {
        $fabricationSpecification = $this->getFabricationSpecification();

        $fabricationArray = [];
        foreach ($fabricationSpecification->getActorMap() as $actor) {
            $fabricationArray[self::KEY_ACTORS][$actor->getActorKey()] =
                [
                    self::KEY_TEMPLATE => $actor->getTemplatePath()
                ];
        }

        $writeDirectory = $this->getDirectoryFromWritePath($this->getWritePath());
        if (!file_exists($writeDirectory)) {
            mkdir($writeDirectory, 0777, true);
        }

        $yaml = Yaml::dump($fabricationArray, 10);
        file_put_contents($this->getWritePath(), $yaml);

        return $this;
    }

    protected function getDirectoryFromWritePath(string $writePath) {
        $writePathArray = explode('/', $writePath);
        array_pop($writePathArray);

        return implode('/', $writePathArray);
    }
    protected function getFabricationSpecification() : FabricationSpecificationInterface
    {
        if ($this->fabricationSpecification === null) {
            throw new \LogicException('Writer fabricationSpecification has not been set.');
        }
        return $this->fabricationSpecification;
    }

    public function setFabricationSpecification(FabricationSpecificationInterface $fabricationSpecification) : WriterInterface
    {
        if ($this->fabricationSpecification !== null) {
            throw new \LogicException('Writer fabricationSpecification is already set.');
        }
        $this->fabricationSpecification = $fabricationSpecification;
        return $this;
    }

    protected function getWritePath() : string
    {
        if ($this->writePath === null) {
            throw new \LogicException('Writer writePath has not been set.');
        }
        return $this->writePath;
    }

    public function setWritePath(string $writeDirectory) : WriterInterface
    {
        if ($this->writePath !== null) {
            throw new \LogicException('Writer writePath is already set.');
        }
        $this->writePath = $writeDirectory;
        return $this;
    }
}
