<?php 

    function returnsJson($error, $message, $others = FALSE)
    {
        $data = array('error' => $error, 'message' => $message);
        
        if ($others)
        {
            foreach ($others as $k => $v)
                $data[$k] = $v;
        }
        
        die(json_encode($data));
    }
    
    function returnsOk($message, $others = FALSE)
    {
        returnsJson(0, $message, $others);
    }
    
    function returnsFail($message, $others = FALSE)
    {
        returnsJson(1, $message, $others);
    }
        
    function returnWarning($error, $message, $others = FALSE){
        returnsJson(2, $message, $others);
    }