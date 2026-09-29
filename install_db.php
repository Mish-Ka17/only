<?php
require_once __DIR__.'/vendor/config.php';

$host= DB_HOST;
$username = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;

//1. Подключение к серверу MySQL (без указания БД)

$dsn = "mysql:host=$host";
try {
    $pdo = new PDO($dsn, $username, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. Создание базы данных
    $sql_db = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        
    $pdo->exec($sql_db);
    echo "<p>База данных $dbname создана.</p>";

// 3. Подключение к созданной базе данных
    $pdo->exec("USE `$dbname`");

// 4. Создание таблицы users
    $sql_table = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE, 
        phone VARCHAR(20) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql_table);
    echo '<p>Таблица users создана.</p>
        <p>Установка завершена успешно!</p>
        <p><a href="main_page.php">Продолжить</a></p>';

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
