
<?php

use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

$deleteRepository  = new PdoStudentRepository(ConnectionCreator::createConnection());
$deleteRepository->remove();
