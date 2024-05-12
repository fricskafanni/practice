<?php 
    require_once __DIR__ . '/config/config.php';

    $response = $user->updateUserByAdmin();
    if($response){
        returnsOk($response);
    } else {
        returnsFail($user->getError());
    }