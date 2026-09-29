<?php
require_once 'functions.php';
require_once 'connect.php';
    //***Проверка reCaptcha** */
$url = 'https://google.com/recaptcha/api/siteverify';

$data = [
    'secret' => '6LfRa8wtAAAAAHi8HSp-H4AzUPmu6520DSxodAEK',
    'response' => $_POST['g-recaptcha-response']
];

$options = [
    'http' => ['header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
        ]
];

$context = stream_context_create($options);

$res = file_get_contents($url, false, $context);

$res = json_decode($res, false);

if ($res->success) { //Капча успешно пройдена (success)

        // Проверка наличия телефона или email-а в БД        
        $user = filter_var(trim($_POST['user']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

        $_SESSION['user']=$user;
        $_SESSION['password']=$password;

        if ((substr($user,0,2) === '+7' || substr($user,0,1) === '8') && !str_contains($user, "@")) {
            $user = substr($user, -10);
            $sql = "SELECT * FROM users WHERE phone = ? LIMIT 1";
        }
            else {

            $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
            }

        $stmt = $conn->prepare($sql);
        $stmt->execute([$user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //var_dump($result);

        if(!empty($result)) {
            if (password_verify($password, $result['password'])) { //успешный вход
                $_SESSION['id'] = $result['id'];
                $_SESSION['name'] = $result['name'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['phone'] = '+7'.$result['phone'];
                $_SESSION['password'] = $password;
                header('Location: ../authuser_page.php');
                exit();
                } // redirect('Успешный вход','../authuser_page.php');}
            else {redirect ('Неверный пароль', AUTH_PATH);}

        } else {
            redirect ('Пользователь не найден <br><br><a href="'.REG_PATH.'" >Зарегистрироваться</a>', AUTH_PATH);
        }
} else { //капча не пройдена
        redirect('Подтвердите, что вы не робот', AUTH_PATH);   
}