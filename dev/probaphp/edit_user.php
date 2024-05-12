<?php
    require_once __DIR__ . '/config/config.php';
    
    $page_title = "Edit User page";
    
    //var_dump($_SESSION);
    
    // get user_email
    $userData = $user->getEditUser();
    if (empty($userData))
    {
        header('Location: admin.php');
        die;
    }
    
    $id = $userData['id'];
    $userEmail = $userData['email'];
    $userName = $userData['name'];
    $userLastname = $userData['lastname'];
    $userDob = date('d/m/Y', strtotime($userData['dob']));
    
    require_once __DIR__ . '/views/header.php';
    require_once __DIR__ . '/views/edit_user_page.php';
    require_once __DIR__ . '/views/footer.php';