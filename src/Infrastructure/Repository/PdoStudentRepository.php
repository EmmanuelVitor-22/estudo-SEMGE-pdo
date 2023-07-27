<?php
namespace Emmanuel\Infrastructure\Repository;

use Emmanuel\Domain\Model\Students;
use Emmanuel\Domain\Repository\StudentRepository;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use http\Exception;
use PDO;

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
            // Verifica se o campo 'name' não é nulo antes de criar o objeto Students
            if (isset($student['id'], $student["name"], $student['birth_date'])) {
                $resultAllStudentsObj[] = new Students($student['id'], $student["name"], new \DateTimeImmutable($student['birth_date']));
            }
        }

        return $resultAllStudentsObj;
    }

    public function studentsBirthAt($birth_date): array
    {
        $queryAllStudentsBirthAt = $this->connection->prepare('SELECT * FROM students WHERE birth_date = ?');
        $queryAllStudentsBirthAt->bindValue(1, $birth_date);
        $queryAllStudentsBirthAt->execute();

        $listAllStudentsBirthAt = $queryAllStudentsBirthAt->fetchAll(\PDO::FETCH_ASSOC);

        $resultAllStudentsObj = [];
        foreach ($listAllStudentsBirthAt as $student) {
            // Verifica se o campo 'name' não é nulo antes de criar o objeto Students
            if (isset($student['id'], $student["name"], $student['birth_date'])) {
                $resultAllStudentsObj[] = new Students($student['id'], $student["name"], new \DateTimeImmutable($student['$birth_date']));
            }
        }
        return $resultAllStudentsObj;
    }

    public function studentById($id): array
    {
        $pdo = $this->connection;
        $queryAllStudentsBirthAt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
        $queryAllStudentsBirthAt->bindValue(1, $id);
        $queryAllStudentsBirthAt->execute();

        $listAllStudentsBirthAt = $queryAllStudentsBirthAt->fetchAll(\PDO::FETCH_ASSOC);

        $resultAllStudentsObj = [];
        foreach ($listAllStudentsBirthAt as $student) {
            $resultAllStudentsObj[] = new Students($student['id'], $student["name"], new \DateTimeImmutable($student['$birth_date']));
        }
        return $resultAllStudentsObj;
    }

    public function save(Students $student): bool
    {

        try {
            $queryInsertInto = $this->connection->prepare('INSERT INTO students (name, birth_date) VALUES (?,?)');
            $queryInsertInto->bindValue(1, $student->getName());
            $queryInsertInto->bindValue(2, $student->getBirthDate()->format('Y-m-d'));
            $queryInsertInto->execute();
            echo "O estudante com  {$student->getName()} foi cadastrado";
            return true;
        } catch (\PDOException $PDOException) {
            throw  new \Exception($PDOException->getMessage());
        }
    }

    public function remove(Students $student): bool
    {
        try {
            $pdo = $this->connection;
            $queryDeleteStudent = $pdo->prepare('DELETE FROM students WHERE id :id');
            $queryDeleteStudent->bindValue(":id", $student->getId(), PDO::PARAM_INT);
            $queryDeleteStudent->execute();
            if ($queryDeleteStudent->rowCount() > 0) {
                print_r( "O estudandote $student foi excluido");
                return true;
            }
            print_r ("Você tentou excluir um estudante com id $student porém houve algum problemas.
            Reveja as informações e corrija se nescessario.");
            return false;
        } catch (\PDOException $PDOException) {
            throw  new \Exception($PDOException->getMessage());
        }
    }
    public function update($id, $studentName=null,$studentBirthDate = null):bool
    {
        $pdo = $this->connection;
        $stmt = 'UPDATE students SET ';

        $stmt = 'UPDATE students SET ';
        if((!empty($studentName)) && (!empty($studentBirthDate))){
            $stmt .= 'name = ?, birth_date = ? WHERE id = ?';
            $query = $pdo->prepare($stmt);
            $query->bindValue(1, $studentName);
            $query->bindValue(2, $studentBirthDate->format('Y-m-d'));
            $query->bindValue(3, $id);
        }elseif (!empty($studentBirthDate)){
            if(empty($studentName)|| $studentName == null){
                $stmt .= ' birth_date = ? WHERE id = ?';
                $query = $pdo->prepare($stmt);
                $query->bindValue(1, $studentBirthDate->format('Y-m-d'));
                $query->bindValue(2, $id);
            }

        }
        else{
            $stmt .= 'name = ? WHERE id = ?';
            $query = $pdo->prepare($stmt);
            $query->bindValue(1, $studentName);
            $query->bindValue(2, $id);
        }

        if ($query->execute()) {
            echo 'Estudante atualizado com sucesso';
            return true;
        } else {
            echo 'Erro ao atualizar o estudante';
            return false;
        }
    }

}