<?php

namespace Emmanuel\Domain\Repository;

use Emmanuel\Domain\Model\Phone;
use Emmanuel\Domain\Model\Students;

interface StudentRepository
{
    public function allStudent():array;
    public function studentsBirthAt( \DateTimeInterface $bith_date):array;
    //public function studentsWithPhone():array;
    public function studentsById(Students $student):array;
    public function save(Students $student, Phone $phone ):bool;
    public function savePhone(Students $student, Phone $phone ):bool;

    public function remove():bool;
    public function update(Students $student):bool;
}