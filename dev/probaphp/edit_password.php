<?php
    require_once __DIR__ . '/config/config.php';
    
    $page_title = "Change User password";
    
    //var_dump($_SESSION);
    
    // get user_email
    //$userPassword = $user->getUserPassword();
    $userData = $user->getEditUser();
    
    if (empty($userData))
    {
        header('Location: admin.php');
        die;
    }
    
    $id = $userData['id'];
    $password = $userData['pass'];
    
    require_once __DIR__ . '/views/header.php';
    require_once __DIR__ . '/views/change_password.php';
    require_once __DIR__ . '/views/footer.php';