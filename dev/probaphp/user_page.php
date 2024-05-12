<?php
require_once __DIR__ . '/config/config.php';

if (!$user->isLoggedIn())
{
    header('Location: index.php');
    exit();
}

$page_title = "User page";

$userData = $user->get();
if (empty($userData))
{
    header('Location: index.php');
    exit();
}
$email = $userData['email'];
$name = $userData['name'];
$lastname = $userData['lastname'];
$dob = date('d/m/Y', strtotime($userData['dob']));

require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/user.php';
require_once __DIR__ . '/views/footer.php';