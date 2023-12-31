<?php
namespace Emmanuel\Infrastructure\Repository;

use Emmanuel\Domain\Model\Phone;
use Emmanuel\Domain\Model\Students;
use Emmanuel\Domain\Repository\StudentRepository;
use Emmanuel\Infrastructure\Persistence\ConnectionCreator;
use http\Exception;
use PDO;

require "vendor/autoload.php";

class PdoStudentRepository implements StudentRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    private function hydrateStudentList(\PDOStatement  $PDOStatement)
    {
        $studentsDataList = $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
        $resultStudentList= [];

        foreach ($studentsDataList as $studentData) {
            // Verifica se o campo 'name' não é nulo antes de criar o objeto Students
            if (isset($studentData['id'], $studentData["name"], $studentData['birth_date'])) {
                $student = new Students($studentData['id'],
                                        $studentData["name"],
                                        new \DateTimeImmutable($studentData['birth_date'])
                                       );
                $resultStudentList[] = $student;
            }
        }
        return $resultStudentList;
    }
// ...
    public function studentsWithPhone(): array
    {
        $pdo = $this->connection;
        $queryStudentsWithPhone = $pdo->query('SELECT
        students.id AS student_id,
        students.name,
        students.birth_date,
        phones.id AS phone_id,
        phones.area_code,
        phones.number
        FROM students
        JOIN phones ON phones.student_id = students.id');

        $result = $queryStudentsWithPhone->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($result as $row) {
            if (!array_key_exists($row['student_id'], $studentList)) {
                $studentList[$row['student_id']] = new Students(
                    $row['student_id'],
                    $row["name"],
                    new \DateTimeImmutable($row['birth_date'])
                );
            }
            $studentList[$row['student_id']]->setPhones($row['phone_id'], $row['area_code'], $row['number']);
        }

        return $studentList;
    }
// ...

    public function allStudent(): array
    {
        $queryAllStudents = $this->connection->query('SELECT * FROM students');
        return $this->hydrateStudentList($queryAllStudents);
    }
    public function studentsBirthAt(\DateTimeInterface $birth_date): array
    {
        $queryAllStudentsBirthAt = $this->connection->prepare('SELECT * FROM students WHERE birth_date = ?');
        $queryAllStudentsBirthAt->execute([$birth_date->format("Y-m-d")]);

        return $this->hydrateStudentList($queryAllStudentsBirthAt);
    }
    public function studentsById(Students $student): array
    {
        $pdo = $this->connection;
        $queryStudentsById = $pdo->prepare('SELECT * FROM students WHERE id = ?');
        $queryStudentsById->execute([$student->getId()]);

        return $this->hydrateStudentList($queryStudentsById);

    }
    //metodo utilizado para salvar persistencia de novo cadastro
    public function save(Students $student): bool
    {
        //verifica se o aluno exise ou não (se id == null ainda n existe)
        if ($student->getId()===null){
           return $this->insertStudent($student) ;
        }
        return $this->update($student);

    }
    public function insertStudent(Students $student):bool
    {
        $pdo = $this->connection;

        try {
            $queryInsertInto = $this->connection->prepare('INSERT INTO students (name, birth_date) 
                                                                  VALUES (:name,:birth_date)');
            $success = $queryInsertInto->execute([
                ":name" => $student->getName(),
                ":birth_date" => $student->getBirthDate()->format('Y-m-d')
            ]);
            /*lastInsertId(): Este é um método da classe PDO que é chamado após a inserção de um novo registro no banco de dados usando uma declaração SQL como o INSERT.
            Ele retorna o ID do último registro inserido na tabela específica que possui uma coluna autoincrementável.
            Esse ID normalmente é gerado automaticamente pelo banco de dados, e é único para cada registro inserido na tabela*/
            //nesse caso, o valor retornado está sendo usado para definir(set) o valor do id do objeto student criado;
            // verificação de q somente funcionará se execução da declaração for verdadeira
            if($success) {
                $studentId = $pdo->lastInsertId();
                $student->defineId($studentId);
                $this->insertPhone($student);
            }
            echo "O(A) estudante {$student->getName()} foi cadastrado(a)."
                  . PHP_EOL .
            " Seus telefones são: {$phone->formattedPhone()}";
            return $success;
        } catch (\PDOException $PDOException) {
            throw  new \Exception($PDOException->getMessage());
        }
    }

//    responsavel por inserir (somente iss) telefone
    public function insertPhone(Students $student): bool
    {
        $pdo = $this->connection;
        // Insere os telefones associados ao aluno na tabela phones
        foreach ($student->getPhones() as $phone) {
            $queryInsertPhone= $pdo->prepare('INSERT INTO phones (student_id, area_code, number )
                                                             VALUES  (:student_id, :area_code, :number )');
           $success =  $queryInsertPhone->execute([
                ":student_id" => $student->getId(),
                ":area_code" => $phone->getAreaCode(),
                ":number" => $phone->getNumber()
            ]);
            if(!$success ) {
                return false;
            }

            $phoneId = $pdo->lastInsertId();
            $phone->defineId($phoneId);
        }
        return true;
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

//    private function fillPhoneOf(Students $student)
//    {
//        $pdo=$this->connection;
//        $query= $pdo->prepare('SELECT id, area_code, number FROM phones WHERE student_id = :id ');
//        $query->execute([':id'=>$student->getId()]);
//
//        $resultDataPhone = $query->fetchAll(PDO::FETCH_ASSOC);
//
//        foreach ($resultDataPhone as $dataPhone) {
//            $studentPhone = new Phone($dataPhone['id'],
//                                      $dataPhone['area_code'],
//                                      $dataPhone['number']
//                                     );
//            $student->setPhones($studentPhone);
//        }
//
//    }

}