<?php



use Emmanuel\Infrastructure\Repository\PdoStudentRepository;

require 'vendor/autoload.php';

//$pdo = new PDO('sqlite:' . $database);
//
//$removePreparedStatement =  $pdo->prepare("DELETE FROM students WHERE id=? ");
//$removePreparedStatement->bindValue(1, 2, PDO::PARAM_INT);
//var_dump($removePreparedStatement->execute());
//if ($removePreparedStatement->rowCount()>0){
//    echo $removePreparedStatement->rowCount();
//}else{
//    echo "não";
//}
$deleteRepository  = new PdoStudentRepository();
$deleteRepository->remove(4);


