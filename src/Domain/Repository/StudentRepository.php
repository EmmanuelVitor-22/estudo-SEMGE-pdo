<?php

namespace Emmanuel\Domain\Repository;

interface StudentRepository
{
    public function allStudent():array;
    public function studentsBirthAt():array;
    public function save():bool;
    public function remove():bool;
    public function update():bool;
}