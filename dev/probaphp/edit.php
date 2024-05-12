<?php
require_once __DIR__ . '/config/config.php';

if(!$user->isLoggedIn()){
    header('Location: index.php');
}

$page_title = "Edit User page";

$userData = $user->get();

if(empty($userData))
{
    header('Location: index.php');
    exit();
}
$email = $_SESSION['user']['email'];
$name = $_SESSION['user']['name'];
$lastname = $_SESSION['user']['lastname'];
$dob = date('d/m/Y', strtotime($_SESSION['user']['dob']));

require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/update_user_page.php';
require_once __DIR__ . '/views/footer.php';