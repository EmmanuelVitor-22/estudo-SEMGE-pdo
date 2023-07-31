<?php

use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

//$pdo = ConnectionCreator::createConnection();
$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

$connection->beginTransaction();

$emmanuel =  new Students(null, "Jhon Vitor", new DateTimeImmutable("1999-03-01"));
//
$studentRepository->save($emmanuel);

$connection->commit();


// forma simples de inserir
//$sqlInsert = "INSERT INTO students (name, birth_date) VALUES ('{$student->getName()}','{$student->getBirthDate()->format('Y-m-d')}');";
//$result = $pdo->exec($sqlInsert);
//var_dump($result);

// Usando SQL Injection
//forma simples
//$insert = "INSERT INTO students (name, birth_date) VALUES (?,?)";
////forma nomeada
////$insert = "INSERT INTO students (name, birth_date) VALUES (:name,:birth_date)";
//
//$statement = $pdo->prepare($insert);
//$statement->bindValue(1,$student->getName());
//$statement->bindValue(2,$student->getBirthDate()->format('Y-m-d'));
//$statement->execute();


