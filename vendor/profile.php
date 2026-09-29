<?php
require_once 'functions.php';
require_once 'connect.php';
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password_confirm = filter_var(trim($_POST['password_confirm']), FILTER_SANITIZE_STRING);

$_SESSION['name']=$name;
$_SESSION['phone']=$phone;
$_SESSION['email']=$email;
$_SESSION['password']=$password;

if (mb_strlen($name) < 4 || mb_strlen($name) > 50) redirect('Недопустимая длина имени', PROFILE_PATH);

// if (!preg_match("/^(?:\+7|8)[ u00A0u202F-]?(?:([0-9]{3})|[0-9]{3})[ u00A0u202F-]?[0-9]{3}[ u00A0u202F-]?[0-9]{2}[ u00A0u202F-]?[0-9]{2}$/", $phone))
//     redirect('Недопустимый номер телефона');
if (!preg_match("/^(?:\+7|8)\d{10}$/", $phone)) redirect('Недопустимый номер телефона', PROFILE_PATH);
if (mb_strlen($password) < 6 || mb_strlen($password) > 50) redirect('Недопустимая длина пароля', PROFILE_PATH);


// Проверка существования имени, телефона и email-а в БД 
$phone = $phone[0] === '+' && $phone[1] === '7' ? substr($phone, 2, 10): substr($phone, 1, 10);

$sql = "SELECT * FROM users WHERE (name = ? OR phone = ? OR email = ?) AND id != ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$name, $phone, $email, $_SESSION['id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC); //var_dump($result);

if (!empty($result))
    {
        if ($result['name'] === $name) 
        {
            redirect('Такое имя уже имеется', PROFILE_PATH);
        } else {
            if ($result['phone'] === $phone)
            {
                redirect('Такой телефон уже имеется', PROFILE_PATH);
            } else {
                    if ($result['email'] === $email)
                    {
                        redirect('Такой email уже имеется', PROFILE_PATH);
                    }
            }
        }
    }
// Проверка совпадения паролей

if (!($password === $password_confirm))
    {
        redirect('Пароли не совпадают', PROFILE_PATH);
    }
else { //update данных пользователя в БД
        
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET name = ?, phone = ?, email = ?, password = ?, updated_at =? WHERE users.id = ?";
    // $query = "INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$name, $phone, $email, $hash, date('Y-m-d H:i:s'), $_SESSION['id']]);
        
     header('Location: ../authuser_page.php');
    exit();
    }
