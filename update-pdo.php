<?php

use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

$pdoRepositoryStudent =  new PdoStudentRepository();
$pdoRepositoryStudent->update(2,"Lucas Dias");

