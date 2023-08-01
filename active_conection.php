<?php
require 'vendor/autoload.php';
try {
    $database =  __DIR__ . '/database.sqlite';
    $pdo = new PDO('sqlite:' . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD

=======
>>>>>>> 1e7587d7aea770d0d61254b52351c0b45c2b3b3e
}catch (PDOException $exception){
    echo "Erro" . $exception->getMessage();
}
