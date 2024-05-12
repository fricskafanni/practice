<?php 
    require_once __DIR__ . '/config/config.php';

    $response = $user->CreateNewUser();
    if($response){
        if($response['error'] == 0){
            returnsOk('Ok');
        }else {
            returnWarning($response['error'], $response['message']);
        }
    } else {
        returnsFail($user->getError());
    }