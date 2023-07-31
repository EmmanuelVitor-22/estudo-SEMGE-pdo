<?php
require 'vendor/autoload.php';
try {
    $database =  __DIR__ . '/database.sqlite';
    $pdo = new PDO('sqlite:' . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $createTable =  '
        CREATE TABLE IF NOT EXISTS students ( 
         id INTEGER PRIMARY KEY ,
         name TEXT, 
         birth_date TEXT
        );
           
        CREATE TABLE IF NOT EXISTS phones ( 
             id INTEGER PRIMARY KEY,
             area_code TEXT, 
             number TEXT,
             student_id INTEGER,
             FOREIGN KEY (student_id) REFERENCES students(id)
        );
';
    $insert = "INSERT INTO phones (area_code, number, student_id)
                VALUES ( '000', '111111111', 1),('111', '999999999', 1);";
  $pdo->exec($insert);


}catch (PDOException $exception){
    echo "Erro" . $exception->getMessage();
}
