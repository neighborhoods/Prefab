#!/usr/bin/env php
<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$annotationProcessor = new \Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder();
$replacement = $annotationProcessor->setAnnotationProcessorContext(
    (new \Neighborhoods\Bradfab\AnnotationProcessor\Context())
        ->setStaticContextRecord(
            [
                'properties' => [
                    'alias' => [
                        'data_type' => 'int',
                        'database_column_name' => 'alias',
                        'nullable' => false,
                    ],
                    'address' => [
                        'data_type' => '\Neighborhoods\PropertyService\MV1\AddressInterface',
                        'database_column_name' => 'address_1',
                        'nullable' => false,
                    ],
                    'other_address' => [
                        'data_type' => '\Neighborhoods\PropertyService\MV1\AddressInterface',
                        'database_column_name' => 'address_1',
                        'nullable' => true,
                    ],
                    'parcelapn' => [
                        'data_type' => 'string',
                        'database_column_name' => 'parcelapn',
                        'nullable' => true,
                    ],
                ]
            ]
        )
)->getReplacement();

var_export($replacement);
