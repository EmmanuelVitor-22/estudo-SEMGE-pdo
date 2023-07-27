<?php

namespace Emmanuel\Domain\Repository;

use Emmanuel\Domain\Model\Students;

interface StudentRepository
{
    public function allStudent():array;
    public function studentsBirthAt( $bith_date):array;
    public function save(Students $student):bool;
    public function remove($id):bool;
    public function update():bool;
}