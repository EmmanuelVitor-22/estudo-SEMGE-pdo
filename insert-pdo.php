<?php

use Emmanuel\Domain\Model\Students;

require 'vendor/autoload.php';
$database =  __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $database);

$student = new Students(null,"Juc",new DateTimeImmutable("2000-12-06"));
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES ('{$student->getName()}','{$student->getBirthDate()->format('Y-m-d')}');";
$result = $pdo->exec($sqlInsert);
var_dump($result);