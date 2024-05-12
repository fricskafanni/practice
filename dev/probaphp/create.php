<?php
require_once __DIR__ . '/config/config.php';

if(!$user->isLoggedIn()){
    header('Location: index.php');
}

$page_title = "Create User page";

require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/create_user_page.php';
require_once __DIR__ . '/views/footer.php';