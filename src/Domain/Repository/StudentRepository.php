<?php

namespace Emmanuel\Domain\Repository;

use Emmanuel\Domain\Model\Students;

interface StudentRepository
{
    public function allStudent():array;
    public function studentsBirthAt( $bith_date):array;
    public function save(Students $student):bool;
    public function remove(Students $student):bool;
    public function update($id, $studentName=null,$studentBirthDate=null):bool;
}