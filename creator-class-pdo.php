<?php

use Emmanuel\Domain\Model\Students;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

