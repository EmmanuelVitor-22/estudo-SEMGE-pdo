<?php

use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

//$pdo = ConnectionCreator::createConnection();
$student = new Students(null,"Naci Lima",new DateTimeImmutable("1996-10-30"));
// usando padrao repository
$insert = new PdoStudentRepository();
$insert->save($student);

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


