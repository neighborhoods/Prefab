<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit;

use Neighborhoods\Prefab\BuildPlan;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BuildPlanTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnSelfWhenExecuting(): void
    {
        $buildPlan = new BuildPlan();

        $this->assertSame(
            $buildPlan,
            $buildPlan->execute()
        );
    }

    /**
     * @test
     */
    public function shouldReturnSelfWhenAppendingGenerator(): void
    {
        $buildPlan = new BuildPlan();

        $this->assertSame(
            $buildPlan,
            $buildPlan->appendGenerator($this->getGeneratorMock())
        );
    }

    /**
     * @test
     */
    public function shouldGenerateEachGenerator(): void
    {
        $generator1 = $this->getGeneratorMock();
        $generator1->expects($this->once())
            ->method('generate');

        $generator2 = $this->getGeneratorMock();
        $generator2->expects($this->once())
            ->method('generate');

        $generator3 = $this->getGeneratorMock();
        $generator3->expects($this->once())
            ->method('generate');

        $buildPlan = new BuildPlan();

        $buildPlan->appendGenerator($generator1);
        $buildPlan->appendGenerator($generator2);
        $buildPlan->appendGenerator($generator3);

        $buildPlan->execute();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|GeneratorInterface
     */
    private function getGeneratorMock(): MockObject
    {
        return $this->getMockBuilder(GeneratorInterface::class)
            ->getMock();
    }
}
