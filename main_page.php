<?php
require_once 'vendor/functions.php';
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only-Test</title>
    <link href = "/assets/css/main.css" rel = "stylesheet">
</head>
<body>
    <div class="title">
        <h1>Главная страница</h1>
        
            <?if(is_auth())
                echo '<div class="user">Вы авторизованы как: <span class="name-email"><span class="name">'.$_SESSION['name'].'</span>
                    email: <span class="name">'.$_SESSION['email'].'</span></span></div>';
                else echo '<div class="user">Вы неавторизованы</div>';
            ?>
        
    </div>
    <div class="link">
    </div>
    <div class="container">
        <?if (is_auth())
            echo '<div><a href="authuser_page.php">Страница пользователя</a></div>
                <div><a href="vendor/logout.php">Выйти</a></div>';
            else echo '<div><a href="auth_form.php">Вход</a></div>
                <div><a href="reg_form.php">Регистрация</a></div>';
        ?>
    </div>
</body>
</html>