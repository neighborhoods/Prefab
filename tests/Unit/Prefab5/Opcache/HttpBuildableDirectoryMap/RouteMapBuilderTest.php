<?php

namespace tests\Unit\Prefab5\Opcache\HttpBuildableDirectoryMap;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\RouteMapBuilder;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class RouteMapBuilderTest extends TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $filesystem;

    protected function setUp()
    {
        parent::setUp();

        $this->filesystem = vfsStream::setup();
    }

    /**
     * @test
     */
    public function shouldPreventMutatingNamespace() : void
    {
        static::expectException(\LogicException::class);
        static::expectExceptionMessage('RouteMapBuilder namespace is already set.');

        $routeMapBuilder = new RouteMapBuilder();
        $routeMapBuilder->setNamespace('unimportant')
            ->setNamespace('also unimportant');
    }

    /**
     * @test
     */
    public function shouldPreventMutatingFilePath() : void
    {
        static::expectException(\LogicException::class);
        static::expectExceptionMessage('RouteFileParser routeFilePath is already set.');

        $routeMapBuilder = new RouteMapBuilder();
        $routeMapBuilder->setRouteFilePath('unimportant')
            ->setRouteFilePath('also unimportant');
    }

    /**
     * @test
     */
    public function shouldBuildRouteMap() : void
    {
        $routeMapBuilder = new RouteMapBuilder();
        $expectedMap = [
            'get' => [ 'MV1' => true ],
            'post' => ['DOR2' => true]
        ];

        $serviceRouteFile = <<<EOF
services:
  Neighborhoods\SomeService\Prefab5\Zend\Expressive\Application\DecoratorInterface:
    class: Neighborhoods\SomeService\Prefab5\Zend\Expressive\Application\Decorator
    decorates: Zend\Expressive\Application
    calls:
    - [setZendExpressiveApplication, ['@Neighborhoods\SomeService\Prefab5\Zend\Expressive\Application\DecoratorInterface.inner']]
    - [get, [!php/const \Neighborhoods\SomeService\MV1\Address\Map\Repository\HandlerInterface::ROUTE_PATH_ADDRESSS,'@Neighborhoods\SomeService\MV1\Address\Map\Repository\HandlerInterface',!php/const \Neighborhoods\SomeService\MV1\Address\Map\Repository\HandlerInterface::ROUTE_NAME_ADDRESSS]]
    - [post, [!php/const \Neighborhoods\SomeService\DOR2\Property\Map\Repository\HandlerInterface::ROUTE_PATH_PROPERTYS,'@Neighborhoods\SomeService\DOR2\Property\Map\Repository\HandlerInterface',!php/const \Neighborhoods\SomeService\DOR2\Property\Map\Repository\HandlerInterface::ROUTE_NAME_PROPERTYS]]
    - [get, [!php/const \Neighborhoods\SomeService\MV1\Coordinate\Map\Repository\HandlerInterface::ROUTE_PATH_COORDINATES,'@Neighborhoods\SomeService\MV1\Coordinate\Map\Repository\HandlerInterface',!php/const \Neighborhoods\SomeService\MV1\Coordinate\Map\Repository\HandlerInterface::ROUTE_NAME_COORDINATES]]
    - [get, [!php/const \Neighborhoods\SomeService\MV1\ParcelPoint\Map\Repository\HandlerInterface::ROUTE_PATH_PARCELPOINTS,'@Neighborhoods\SomeService\MV1\ParcelPoint\Map\Repository\HandlerInterface',!php/const \Neighborhoods\SomeService\MV1\ParcelPoint\Map\Repository\HandlerInterface::ROUTE_NAME_PARCELPOINTS]]
EOF;

        file_put_contents($this->filesystem->url() . '/Decorator.service.yml', $serviceRouteFile);

        $routeMap = $routeMapBuilder
            ->setRouteFilePath($this->filesystem->url() . '/Decorator.service.yml')
            ->setNamespace('Neighborhoods\\SomeService\\')
            ->buildRouteMap();

        static::assertSame($expectedMap, $routeMap);
    }
}
