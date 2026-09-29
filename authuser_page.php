<?php
require_once 'vendor/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only-test</title>
    <link href = "/assets/css/main.css" rel = "stylesheet">
</head>
<body>
    <div class="title">
        <h1>Страница авторизованного пользователя</h1>
        <div class="user">
            <?if (is_auth())
            echo 'Вы авторизованы как: <span class="name-email"><span class="name">'.$_SESSION['name'].'</span>
                email: <span class="name">'.$_SESSION['email'].'</span></span>';    
            ?>
        </div>    
        
    </div>
    <div class="link">
    </div>
    <div class="container">
        <div><a href="profile_form.php">Настройки профиля</a></div>
        <div><a href="vendor/logout.php">Выйти</a></div>

    </div>
</body>
</html>