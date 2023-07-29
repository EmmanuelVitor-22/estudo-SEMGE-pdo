<?php

namespace Emmanuel\Infrastructure\Persistence;
use PDO;
class ConnectionCreator
{

    public static function createConnection(): PDO {
        try {
            $database =  __DIR__ . '/../../../database.sqlite';
            $pdo = new PDO('sqlite:' . $database);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        }catch (\PDOException $PDOException){
            throw new \Exception($PDOException->getMessage());
        }

    }

}