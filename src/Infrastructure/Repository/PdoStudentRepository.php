<?php
namespace Emmanuel\Infrastructure\Repository;

use Emmanuel\Domain\Model\Students;
use Emmanuel\Domain\Repository\StudentRepository;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;

require "vendor/autoload.php";

class PdoStudentRepository implements StudentRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function allStudent(): array
    {
        $queryAllStudents = $this->connection->query('SELECT * FROM students');
        $listAllStudents = $queryAllStudents->fetchAll(\PDO::FETCH_ASSOC);
        $resultAllStudentsObj = [];

        foreach ($listAllStudents as $student) {
            $resultAllStudentsObj[] = new Students($student['id'],$student["name"], new \DateTimeImmutable($student['birth_date']));
        }

        return $resultAllStudentsObj;
    }

    public function studentsBirthAt(): array
    {
        return [];
    }

    public function save(): bool
    {
        return true;
    }

    public function remove(): bool
    {
        return true;
    }

    public function update(): bool
    {
        return true;
    }
}