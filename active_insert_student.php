<?php


use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';
try {
    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);
    $connection->beginTransaction();
<<<<<<< HEAD
    $student = new Students(null, "Teste 03 ", new DateTimeImmutable("2005-03-15"));
    $student->setPhones(null,"+33","33333333");
    $studentRepository->save($student);
    $connection->commit();
} catch (Exception $e) {

=======
    $student = new Students(null, "AAAAAAAAAAA ", new DateTimeImmutable("2005-03-15"));
    $student->setPhones(null,"225","88990088");
    $studentRepository->save($student);
    $connection->commit();
} catch (Exception $e) {
>>>>>>> 1e7587d7aea770d0d61254b52351c0b45c2b3b3e
    echo $e->getMessage();
}






