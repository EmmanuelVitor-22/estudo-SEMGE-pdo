<?php


require 'vendor/autoload.php';

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


