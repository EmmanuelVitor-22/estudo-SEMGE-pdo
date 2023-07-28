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

   //metodo utilizado para salvar persistencia de novo cadastro
    public function save(Students $student): bool
    {
        //verifica se o aluno exise ou não (se id == null ainda n existe)
        if ($student->getId()===null){
           return $this->insertStudent($student);
        }
        return $this->update($student);

    }

    public function insertStudent(Students $student):bool
    {
        $pdo = $this->connection;

        try {
            $queryInsertInto = $this->connection->prepare('INSERT INTO students (name, birth_date) VALUES (?,?)');
            $success = $queryInsertInto->execute([
                1 => $student->getName(),
                2 => $student->getBirthDate()->format('Y-m-d')
            ]);
            /*lastInsertId(): Este é um método da classe PDO que é chamado após a inserção de um novo registro no banco de dados usando uma declaração SQL como o INSERT.
            Ele retorna o ID do último registro inserido na tabela específica que possui uma coluna autoincrementável.
            Esse ID normalmente é gerado automaticamente pelo banco de dados, e é único para cada registro inserido na tabela*/
            //nesse caso, o valor retornado está sendo usado para definir(set) o valor do id do objeto student criado;
            // verificação de q somente funcionará se execução da declaração for verdadeira
            if($success) {
                $student->defineId($pdo->lastInsertId());
            }

            echo "O estudante com  {$student->getName()} foi cadastrado";
            return $success;
        } catch (\PDOException $PDOException) {
            throw  new \Exception($PDOException->getMessage());
        }

    }

    public function remove(Students $student): bool
    {
            $pdo = $this->connection;
            $queryDeleteStudent = $pdo->prepare('DELETE FROM students WHERE id :id');
            $queryDeleteStudent->bindValue(":id", $student->getId(), PDO::PARAM_INT);
            return $queryDeleteStudent->execute();

    }
    public function update(Students $student):bool
    {
        $pdo = $this->connection;
        $updateQuery = $pdo->prepare('UPDATE students SET name = :name, birth_date= :birth_date WHERE id = :id');
        return $updateQuery->execute([ ":name" => $student->getName(),
                                ":birth_date" =>$student->getBirthDate()->format('Y-m-d'),
                                ":id" => $student->getId()
        ]);

    }

}