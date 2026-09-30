<?php
require_once 'functions.php';
 session_destroy(); 
 //var_dump($_SESSION);
 header('Location: /main_page.php'); exit();