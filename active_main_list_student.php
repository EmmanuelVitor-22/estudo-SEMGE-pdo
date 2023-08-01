<?php

use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

try {
    $pdoRepositoryStudent = new PdoStudentRepository(ConnectionCreator::createConnection());
    echo "===================================================\n";
    echo "\t\t Todos estudantes\n";
    echo "===================================================";
    echo PHP_EOL;
    print_r($pdoRepositoryStudent->allStudent());
    echo PHP_EOL;
<<<<<<< HEAD
    echo "===================================================\n";
    echo "\t\t Estudantes com seus mumeros\n";
    echo "===================================================";
    echo PHP_EOL;
    print_r($pdoRepositoryStudent->studentsWithPhone());
    echo PHP_EOL;
=======
//    echo "===================================================\n";
//    echo "\t\t Estudantes com seus mumeros\n";
//    echo "===================================================";
//    echo PHP_EOL;
//    print_r($pdoRepositoryStudent->studentsWithPhone());
//    echo PHP_EOL;
>>>>>>> 1e7587d7aea770d0d61254b52351c0b45c2b3b3e
//    echo "===================================================\n";
//    echo "\t\t Estudantes com por data de Nascimento\n";
//    echo "===================================================";
//    echo PHP_EOL;
//    $date =  new DateTimeImmutable("2000-11-20");
//    print_r($pdoRepositoryStudent->studentsBirthAt($date));

} catch (Exception $e) {
    echo  $e->getMessage();
}
