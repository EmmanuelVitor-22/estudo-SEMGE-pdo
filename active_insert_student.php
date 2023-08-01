<?php


use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';
try {
    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);
    $connection->beginTransaction();
    $Student = new Students(null, "llll Ouliveras", new DateTimeImmutable("2005-03-15"));
    $studentRepository->save($Student);
    $Student->setPhones(null,"225","88990088");
    $connection->commit();
} catch (Exception $e) {
    echo $e->getMessage();
}






