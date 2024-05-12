<?php
require_once __DIR__ . '/config/config.php';

//if ($user->isLoggedIn())
//{
  //  header('Location: user_page.php');
//    die;
//}

$user->logout();

$page_title = "Login";

// TO DO 

require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/login.php';
require_once __DIR__ . '/views/footer.php';