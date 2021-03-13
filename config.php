<?php

$dsn = 'mysql:dbname=banco;localhost';
$dbname = '';
$dbpass = '';

try {
$pdo = new PDO($dsn, $dbname, $dbpass);

} catch (PDOException $e) {
    echo "Falhou a conexão".$e->getMessage();
    exit;
}


?>