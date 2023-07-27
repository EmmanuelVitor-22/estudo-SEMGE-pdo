<?php

use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

$pdoRepositoryStudent =  new PdoStudentRepository();
$pdoRepositoryStudent->update(3,"Luna", new DateTimeImmutable("1999-12-23"));

