<?php

use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

$connection->beginTransaction();

$emmanuel =  new Students(null, "Jhon Vitor", new DateTimeImmutable("1999-03-01"));
$alessandra = new Students(null, "Paula Micaela", new DateTimeImmutable("2003-05-26"));

$studentRepository->save($emmanuel);
$studentRepository->save($alessandra);

$connection->commit();



