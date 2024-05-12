<?php
    
    class MyDBClass
    {
        private $conn;
        private $select_db;
        
        public function __construct()
        {
            $this->conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
            $this->select_db = mysqli_select_db($this->conn, DB_NAME);
            
            if (!$this->select_db) {
                die(json_encode(array('error' => 1, 'message' => 'Something wrong')));
            }

        }
        
    }