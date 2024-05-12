<?php 

require_once __DIR__ . '/config/config.php';

    if($user->deleteUser()){
        returnsOk('Ok');
    } else {
        returnsFail($user->getError());
    }