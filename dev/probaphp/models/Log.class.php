<?php
require_once __DIR__ . '/../models/connection.php';    

class LogClass{
    
    function logData($function, $datas){
        //$numbers = [1, 2, 3, 4, 5];
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $filename = $date . "-" . $time . '.txt';
        //var_dump($filename);
        $f = fopen('log/' . $function . '/' . $filename, 'wb');
        
        if (!$f) {
            die('Error creating the file ' . $datas);
        }
        
        fputs($f, is_array($datas) ? json_encode($datas) : $datas);
        
        

        
       /*
               if ($a != $b)
        {
            // kjlñasdjfñls
            
        }
        else if (
            
            SELECT * FROM table WHERE created > '2023-03-04'
        
        if (1 = 2)
        if (1 >= 2)
        
        
       
       foreach ($datas as $data) {
        var_dump(is_array($datas));
            if (is_array($datas)) {
                $serializedData = implode(' ', $datas);
                var_dump($serializedData);
            } else {
                $serializedData = $datas;
            }
            
            fputs($f, $serializedData . PHP_EOL);
        }*/
        
        fclose($f);
    }
}