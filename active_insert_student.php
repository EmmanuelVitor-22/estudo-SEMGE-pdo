<?php


use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';
try {
    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);
    $connection->beginTransaction();
    $student = new Students(null, "Teste 03 ", new DateTimeImmutable("2005-03-15"));
    $student->setPhones(null,"+33","33333333");
    $studentRepository->save($student);
    $connection->commit();
} catch (Exception $e) {

    echo $e->getMessage();
}






