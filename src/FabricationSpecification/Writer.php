<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;
use Symfony\Component\Yaml\Yaml;

class Writer implements WriterInterface
{
    protected const KEY_ACTORS = 'actors';
    protected const KEY_TEMPLATE = 'template';

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FQCN = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD= 'static_context_record';

    protected $fabricationSpecification;
    protected $writePath;

    public function write() : WriterInterface
    {
        $fabricationSpecification = $this->getFabricationSpecification();

        $fabricationArray = [];
        foreach ($fabricationSpecification->getActorMap() as $actor) {
            $annotationProcessors = [];

            foreach ($actor->getAnnotationProcessorRecordMap() as $annotationProcessorRecord) {
                $annotationProcessors[$annotationProcessorRecord->getAnnotationProcessorKey()] = [
                    self::KEY_PROCESSOR_FQCN => $annotationProcessorRecord->getProcessorFullyQualifiedClassname(),
                    self::KEY_STATIC_CONTEXT_RECORD => $annotationProcessorRecord->getStaticContextRecord()
                ];
            }

            $fabricationArray[self::KEY_ACTORS][$actor->getActorKey()] =
                [
                    self::KEY_TEMPLATE => $actor->getTemplatePath()
                ];

            if (!empty($annotationProcessors)) {
                $fabricationArray[self::KEY_ACTORS]
                    [$actor->getActorKey()]
                        [self::KEY_ANNOTATION_PROCESSORS] = $annotationProcessors;
            }
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
