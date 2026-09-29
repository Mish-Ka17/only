<?php
session_start();
require_once __DIR__.'/config.php';

function is_installed() { //Инициализация проекта (Проверка: существует ли БД и таблица users)

    // $conn = new PDO("mysql:host=DB_HOST", DB_USER, DB_PASS);

    $conn = new mysqli(
        DB_HOST,
        DB_USER,
        DB_PASS,
        ''
    );
        
    if ($conn->connect_error) {
        return false;
    }

    $sql = "SELECT SCHEMA_NAME
            FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([DB_NAME]);

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    }

    $conn->select_db(DB_NAME);

    $result = $conn->query("SHOW TABLES LIKE 'users'");

    return $result->num_rows > 0;
}

function is_auth() { //Проверка авторизации
    if (isset($_SESSION['id'], $_SESSION['name'], $_SESSION['email']))
        {
            return true;
        }
}

function redirect($message, $path = REG_PATH) { //Отображение сообщений и перенаправление пользователя на нужную страницу
    $_SESSION['message']= $message;
    header('Location:'.$path); 
    exit();
}

function oldValue ($fieldName) { //Сохранение введенных ранее значений заполняемых полей
    $oldValue = isset($_SESSION[$fieldName]) ? $_SESSION[$fieldName]: '';
    return $oldValue;
}