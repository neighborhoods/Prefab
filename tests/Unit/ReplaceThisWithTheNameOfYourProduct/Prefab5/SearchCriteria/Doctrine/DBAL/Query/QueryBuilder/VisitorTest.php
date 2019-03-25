<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Repository;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class VisitorTest extends TestCase
{
    /**
     * @test
     */
    public function shouldQueryWhereIsNull(): void
    {
        $expectedField = 'some_field';
        $expectedSql = 'some_field IS NULL';

        $filter = new Filter();
        $filter
            ->setField($expectedField)
            ->setGlue('and')
            ->setCondition('is_null');

        $queryBuilderMock = $this->buildQueryBuilderMock();

        $queryBuilderMock->expects(static::never())
            ->method('createNamedParameter');

        $queryBuilderMock->expects(static::once())
            ->method('andWhere')
            ->with($expectedSql);

        $visitor = new Visitor();

        /**
         * @var MockObject|RepositoryInterface $repoMock
         */
        $repoMock = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repoMock->expects(static::once())
            ->method('createQueryBuilder')
            ->with(DecoratorInterface::ID_CORE)
            ->willReturn($queryBuilderMock);

        $visitor->setDoctrineDBALConnectionDecoratorRepository(
            $repoMock
        );

        $visitor->addFilter($filter);
    }

    /**
     * @test
     */
    public function shouldQueryWhereIsNotNull(): void
    {
        $expectedField = 'some_field';
        $expectedSql = 'some_field IS NOT NULL';

        $filter = new Filter();
        $filter
            ->setField($expectedField)
            ->setGlue('and')
            ->setCondition('is_not_null');

        $queryBuilderMock = $this->buildQueryBuilderMock();

        $queryBuilderMock->expects(static::never())
            ->method('createNamedParameter');

        $queryBuilderMock->expects(static::once())
            ->method('andWhere')
            ->with($expectedSql);

        $visitor = new Visitor();

        /**
         * @var MockObject|RepositoryInterface $repoMock
         */
        $repoMock = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repoMock->expects(static::once())
            ->method('createQueryBuilder')
            ->with(DecoratorInterface::ID_CORE)
            ->willReturn($queryBuilderMock);

        $visitor->setDoctrineDBALConnectionDecoratorRepository(
            $repoMock
        );

        $visitor->addFilter($filter);
    }

    /**
     * @test
     */
    public function shouldQueryWhereStDWithin(): void
    {
        $expectedField = 'some_field';
        $expectedCenter = "'POINT(5, 5)'";
        $expectedRadius = 2;
        $expectedSql = "ST_DWithin($expectedField, $expectedCenter, $expectedRadius)";

        $filter = new Filter();
        $filter
            ->setField($expectedField)
            ->setGlue('and')
            ->setCondition('st_dwithin')
            ->setValues([
                'center' => $expectedCenter,
                'radius' => $expectedRadius,
            ]);

        $queryBuilderMock = $this->buildQueryBuilderMock();

        $queryBuilderMock->expects(static::exactly(2))
            ->method('createNamedParameter')
            ->willReturnCallback(
                function (string $value) : string
                {
                    return $value;
                }
            );

        $queryBuilderMock->expects(static::once())
            ->method('andWhere')
            ->with($expectedSql);

        $visitor = new Visitor();

        /**
         * @var MockObject|RepositoryInterface $repoMock
         */
        $repoMock = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repoMock->expects(static::once())
            ->method('createQueryBuilder')
            ->with(DecoratorInterface::ID_CORE)
            ->willReturn($queryBuilderMock);

        $visitor->setDoctrineDBALConnectionDecoratorRepository(
            $repoMock
        );

        $visitor->addFilter($filter);
    }

    /**
     * @test
     */
    public function shouldQueryWhereStWithin(): void
    {
        $expectedField = 'some_field';
        $expectedCenter = "'POINT(5, 5)'";
        $expectedRadius = 2;
        $expectedSql = "ST_Within($expectedField, st_buffer(st_geomfromtext($expectedCenter), $expectedRadius))";

        $filter = new Filter();
        $filter
            ->setField($expectedField)
            ->setGlue('and')
            ->setCondition('st_within')
            ->setValues([
                'center' => $expectedCenter,
                'radius' => $expectedRadius,
            ]);

        $queryBuilderMock = $this->buildQueryBuilderMock();

        $queryBuilderMock->expects(static::exactly(2))
            ->method('createNamedParameter')
            ->willReturnCallback(
                function (string $value) : string
                {
                    return $value;
                }
            );

        $queryBuilderMock->expects(static::once())
            ->method('andWhere')
            ->with($expectedSql);

        $visitor = new Visitor();

        /**
         * @var MockObject|RepositoryInterface $repoMock
         */
        $repoMock = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repoMock->expects(static::once())
            ->method('createQueryBuilder')
            ->with(DecoratorInterface::ID_CORE)
            ->willReturn($queryBuilderMock);

        $visitor->setDoctrineDBALConnectionDecoratorRepository(
            $repoMock
        );

        $visitor->addFilter($filter);
    }

    /**
     * @return MockObject|QueryBuilder
     */
    private function buildQueryBuilderMock(): MockObject
    {
        $connMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $queryBuilderMock->expects(static::any())
            ->method('expr')
            ->willReturn(new ExpressionBuilder($connMock));

        return $queryBuilderMock;
    }
}
