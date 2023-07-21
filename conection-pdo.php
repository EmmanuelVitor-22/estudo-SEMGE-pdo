<?php
require 'vendor/autoload.php';
$database =  __DIR__ . '/database.sqlite';
try {
    $pdo = new PDO('sqlite:' . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY , name TEXT, birth_date TEXT);');

}catch (PDOException $exception){
    echo "Erro" . $exception->getMessage();
}
