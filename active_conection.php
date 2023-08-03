<?php
require 'vendor/autoload.php';
try {
    $database =  __DIR__ . '/database.sqlite';
    $pdo = new PDO('sqlite:' . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



}catch (PDOException $exception){
    echo "Erro" . $exception->getMessage();
}
