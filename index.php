<?php
require_once __DIR__ . '/vendor/functions.php';

if (!is_installed()) { //создание БД
    header('Location: /install_db.php');
    exit();
}

header('Location: /main_page.php');
exit();