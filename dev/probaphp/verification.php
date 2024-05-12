<?php
     
    require_once __DIR__ . '/config/config.php';
    
    /////////////////////////////////////////////////////////////////////
    // get user data from POST, check in db and return if is ok
    /////////////////////////////////////////////////////////////////////
    
    $response = $user->login();
    if ($response['error'] == 0) {
        //return $user->login();
        returnsOk($response['message']);
    }
    else {
        returnsFail($response['message']);
    }
    
    /////////////////////////////////////////////////////////////////////