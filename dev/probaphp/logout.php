<?php 

require_once __DIR__ . '/config/config.php';

$user->logout();
header("Location: index.php");   
die;
