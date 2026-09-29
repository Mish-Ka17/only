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
    <div class="title"><h1>Страница регистрации</h1></div>
    <div class="link">
        <a href="/">На главную</a>        
    </div>
    <div class="container">
        <form action="vendor/register.php" method="POST">
            <?php
                if (isset($_SESSION['message'])) {
                echo '<p class="message">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                }
            ?>
            <label>Имя</label>
            <input type="text" name="name" title="Обязательное поле" required 
                value="<?=oldValue('name') ?>" placeholder="Введите Ваше имя (от 4 до 20 символов)">
                    
            <label>Телефон</label>
            <input type="tel" name="phone" required
                title="Обязательное поле" value="<?=oldValue('phone')?>" placeholder="Введите номер: +79998887766 или 89998887766">
                    
            <label>Эл.почта</label>
            <input type="email" name="email" id="email" required title="Обязательное поле" 
                value="<?=oldValue('email')?>" placeholder="Введите Ваш email (name@example.com)">
                    
            <label>Пароль</label>
            <input type="password" name="password" required 
                value="<?=oldValue('password')?>" placeholder="Введите пароль (от 6 до 20 символов)">
                    
            <label>Повтор пароля</label>
            <input type="password" required name="password_confirm" 
                value="<?=oldValue('password')?>"placeholder="Повторите ввод пароля">
                    
            <input type="submit" value="Регистрация" class="submit">
        </form>
    </div>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>