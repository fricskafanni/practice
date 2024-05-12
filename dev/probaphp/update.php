<?php
    require_once __DIR__ . '/config/config.php';
    
    $response = $user->update();
    
    if(!empty($response)){
        returnsOk($response);
    } else {
        returnsFail($user->getError());
    }

