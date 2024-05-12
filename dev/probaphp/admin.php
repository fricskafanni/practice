<?php
require_once __DIR__ . '/config/config.php';

//if ($user->isLoggedIn())
//{
  //  header('Location: user_page.php');
//    die;
//}

$page_title = "Admin";

$users = $user->listUsers();

$email = $_SESSION['user']['email'];
$name = $_SESSION['user']['name'];
$lastname = $_SESSION['user']['lastname'];
$dob = date('d/m/Y', strtotime($_SESSION['user']['dob']));

require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/main_admin.php';
require_once __DIR__ . '/views/footer.php';