<?php
    use Emmanuel\Domain\Model\Students;
    require 'vendor/autoload.php';
    $database =  __DIR__ . '/database.sqlite';
    $pdo = new PDO('sqlite:' . $database);

    $result = $pdo->query('SELECT * FROM students');
    //Busca os dados inseridos no banco de dados retornando como um array associativo
    $resultDataList = $result->fetchAll(PDO::FETCH_ASSOC);
    //mapeando os dados do banco de dados para objetos em siinstanciando a partir do resultado
    $resultStudentList = [];
    foreach ($resultDataList as $itemList) {
        $resultStudentList[] = new Students($itemList["id"], $itemList["name"], new DateTimeImmutable($itemList["birth_date"]));

        print_r($resultStudentList);
    }
