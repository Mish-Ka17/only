<?php
require_once __DIR__.'/config.php';
$host= DB_HOST;
$username = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;

$dsn = "mysql:host=$host; dbname=$dbname";
try {
    $conn = new PDO($dsn, $username, $pass);
    //echo "Подключение к БД выполнено успешно!";
}
catch (PDOException $exception) {
    exit("Ошибка подключения к БД: {$exception->getMessage()}");
}