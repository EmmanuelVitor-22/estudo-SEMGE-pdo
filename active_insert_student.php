<?php


use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';
try {

    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);
    $connection->beginTransaction();

    $student = new Students(null, "João da Silva", new DateTimeImmutable("2000-05-10"));
    $student->setPhones(null, "+55", "99999999");
    $student->setPhones(null, "+55", "88888888");




    $studentRepository->save($student);

    $connection->commit();
} catch (PDOException $e) {
    echo $e->getMessage();
}






