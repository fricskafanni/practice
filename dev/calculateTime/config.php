<?php 
    session_start();
    
    error_reporting(-1);
	ini_set('display_errors', 1);

    define('DB_HOST', "fanni-practice.devhogarth.com");
    define('DB_USERNAME', "fanni");
    define('DB_PASSWORD', "123456");
    define('DB_NAME', "fanni_db");
    
    //require_once __DIR__ . '/../libraries/common_functions.php';
    require_once __DIR__ . '/Moment.class.php';    

    $moments = new Moment();
    