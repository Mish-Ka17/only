<?php
require_once 'vendor/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>only-test</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="title"><h1>Страница авторизации</h1></div>
    <div class="link">
        <a href="/">На главную</a>        
    </div>
    <div class="container">
        <form action="vendor/auth.php" method="POST">
            <?php
                if (isset($_SESSION['message'])) {
                echo '<p class="message">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                }
            ?>
            <label>Телефон / email</label>
            <input type="text" name="user" required title="Обязательное поле"
                value = "<?=oldValue('user')?>" placeholder="Введите телефон (+7___...или 8___...) или email">
            <label>Пароль</label>
            <input type="password" name="password" required title="Обязательное поле" 
                value = "<?=oldValue('password')?>" placeholder="Введите пароль"><br>
            <!-- <input type="hidden" name="g-recaptcha-response"> -->
            <div class="g-recaptcha" data-sitekey="6LfRa8wtAAAAAA3W1b8TeTeMQAa_F26Vppqgl0wZ"></div>
            <input type="submit" name="submit" class="submit" value="Войти">
        </form>
    </div>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>