<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL;

use Doctrine\DBAL\DriverManager;
use LogicException;
use PDO;
use PDOException;

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

        // Additional error handling classes.
        class_exists(\Doctrine\DBAL\Exception::class);
        class_exists(\Doctrine\DBAL\SQLParserUtils::class);

        return $this;
    }

    private function getPDO(): PDO
    {
        $pdo = null;
        $iteration = 0;
        while (is_null($pdo) && $iteration < 100) {
            $iteration ++;
            try {
                $pdo = new PDO(
                    sprintf('%s:dbname=%s;host=%s', env('DATABASE_ADAPTER'), env('DATABASE_NAME'), env('DATABASE_HOST')),
                    env('DATABASE_USERNAME'),
                    env('DATABASE_PASSWORD'),
                    [
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $exception) {
                sleep(1);
            }
        }
        if (is_null($pdo)) {
            throw new LogicException('Failed to connect to database');
        }
        return $pdo;
    }
}
