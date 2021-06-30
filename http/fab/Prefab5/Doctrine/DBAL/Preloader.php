<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL;

use Doctrine\DBAL\DriverManager;
use PDO;

class Preloader implements PreloaderInterface
{
    public function preload() : PreloaderInterface
    {
        $connection = DriverManager::getConnection([
            'pdo' => $this->getPDO(),
        ]);
        $qb = $connection->createQueryBuilder();
        $qb->select('*')->from('relation')->where($qb->expr()->eq('field', 'value'));
        // no need to execute the query

        return $this;
    }

    private function getPDO(): PDO
    {
        return new PDO(
            sprintf('%s:dbname=%s;host=%s', env('DATABASE_ADAPTER'), env('DATABASE_NAME'), env('DATABASE_HOST')),
            env('DATABASE_USERNAME'),
            env('DATABASE_PASSWORD'),
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
}
