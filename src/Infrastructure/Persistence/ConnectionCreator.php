<?php

namespace Emmanuel\Infrastructure\Persistence;
class ConnectionCreator
{

    public static function createConnection(): \PDO {
        try {
            $database =  __DIR__ . '/../../../database.sqlite';
            $pdo = new PDO('sqlite:' . $database);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (\PDOException $PDOException){
            return "Erro" . $PDOException->getMessage();
        }

    }

}