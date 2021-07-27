<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    private $builder;

    protected function setUp()
    {
        parent::setUp();

        $this->builder = new SearchCriteria\Builder();
        $this->builder->setSearchCriteriaFactory(
            (new SearchCriteria\Factory())->setSearchCriteria(
                // SearchCriteria has a lot of dependencies, just mock it
                $this->createMock(SearchCriteriaInterface::class)
            )
        );
        $this->builder->setSearchCriteriaFilterFactory(
            (new SearchCriteria\Filter\Factory())->setSearchCriteriaFilter(
                new SearchCriteria\Filter()
            )
        );
        $this->builder->setSearchCriteriaSortOrderFactory(
            (new SearchCriteria\SortOrder\Factory())->setSearchCriteriaSortOrder(
                new SearchCriteria\SortOrder()
            )
        );
    }

    /**
     * @dataProvider getValidSearchCriteriaData
     */
    public function testBuildShouldBuild(array $validData): void
    {
        $this->builder->setRecord($validData);
        $searchCriteria = $this->builder->build();
        self::assertNotNull($searchCriteria);
    }

    /**
     * @dataProvider getInvalidSearchCriteriaData
     */
    public function testBuildShouldFail(array $invalidData): void
    {
        $this->builder->setRecord($invalidData);
        $this->expectException(\Throwable::class);
        $this->builder->build();
    }

    public function getValidSearchCriteriaData(): array
    {
        return [
            [[
                'filters' => [
                    [
                        'condition' => 'eq',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['1'],
                    ]
                ],
            ]],
            [[
                'filters' => [
                    [
                        'condition' => 'st_dwithin',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['center' => '0', 'radius' => '5'],
                    ]
                ],
            ]],
            [[
                'filters' => [
                    [
                        'condition' => 'is_null',
                        'glue' => 'and',
                        'field' => 'id',
                    ]
                ],
            ]],
            [[
                'filters' => [
                    [
                        'condition' => 'in',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['1', '2', '3'],
                    ]
                ],
            ]],
        ];
    }

    public function getInvalidSearchCriteriaData(): array
    {
        return [
            // Unsupported condition
            [[
                'filters' => [
                    [
                        'condition' => 'invalid',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['1'],
                    ]
                ],
            ]],
            // Missing values
            [[
                'filters' => [
                    [
                        'condition' => 'eq',
                        'glue' => 'and',
                        'field' => 'id',
                    ]
                ],
            ]],
            [[
                'filters' => [
                    [
                        'condition' => 'st_dwithin',
                        'glue' => 'and',
                        'field' => 'id',
                    ]
                ],
            ]],
            [[
                'filters' => [
                    [
                        'condition' => 'in',
                        'glue' => 'and',
                        'field' => 'id',
                    ]
                ],
            ]],
            // Should be 1 value only
            [[
                'filters' => [
                    [
                        'condition' => 'eq',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['center' => '0', 'radius' => '5'],
                    ]
                ],
            ]],
            // Key must be center and radius
            [[
                'filters' => [
                    [
                        'condition' => 'st_dwithin',
                        'glue' => 'and',
                        'field' => 'id',
                        'values' => ['0', '5'],
                    ]
                ],
            ]],
        ];
    }
}
