<?php
require_once 'vendor/functions.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test of ONLY</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="title"><h1>Страница профиля пользователя</h1>
    <?if(is_auth())
                echo '<div class="user">Вы авторизованы как: <span class="name-email"><span class="name">'.$_SESSION['name'].'</span>
                    email: <span class="name">'.$_SESSION['email'].'</span></span></div>';
                else echo '<div class="user">Вы неавторизованы</div>';
    ?>
    </div>
    <div class="link">
        <a href="vendor/logout.php">Выйти</a>        
    </div>
    <div class="container">
        <form action="vendor/profile.php" method="POST">
            <?php
                if (isset($_SESSION['message'])) {
                echo '<p class="message">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                }
            ?>
            <label>Имя</label>
            <input type="text" name="name" title="Обязательное поле" required 
                value="<?=$_SESSION['name']?>">
                    
            <label>Телефон</label>
            <input type="tel" name="phone" required
                title="Обязательное поле" value="<?=$_SESSION['phone']?>">
                    
            <label>Эл.почта</label>
            <input type="email" name="email" id="email" required title="Обязательное поле" 
                value="<?=$_SESSION['email']?>">
                    
            <label>Пароль</label>
            <input type="password" name="password" required 
                value = "<?=$_SESSION['password']?>" placeholder="Введите пароль (от 6 до 20 символов)">
                    
            <label>Повтор пароля</label>
            <input type="password" required name="password_confirm" 
                value = "<?=$_SESSION['password']?>" placeholder="Повторите ввод пароля">
                    
            <input type="submit" value="Сохранить" class="submit">
        </form>
    </div>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>