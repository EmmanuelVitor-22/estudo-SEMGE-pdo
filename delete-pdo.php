<?php


use Emmanuel\Domain\Model\Students;

require 'vendor/autoload.php';
$database =  __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $database);

$removePreparedStatement =  $pdo->prepare("DELETE FROM students WHERE id=? ");
$removePreparedStatement->bindValue(1, 2, PDO::PARAM_INT);
var_dump($removePreparedStatement->execute());
if ($removePreparedStatement->rowCount()>0){
    echo $removePreparedStatement->rowCount();
}else{
    echo "não";
}


