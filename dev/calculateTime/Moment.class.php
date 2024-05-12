<?php
require_once __DIR__ . '/connection.php';    

class Moment 
{
    private $db;
    private $error;
    
    function __construct() {
        $this->conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
        $this->select_db = mysqli_select_db($this->conn, DB_NAME);
        
        if (!$this->select_db) {
            die(json_encode(array('error' => 1, 'message' => 'Something wrong')));
        }
    
    }
    
    function storeMomentsInTable($moments) {
        foreach ($moments as $moment) {
            $sql = mysqli_query($this->conn, "INSERT INTO moments (resulting_time, id_user, date_assignment) 
            VALUES ('$moment', NULL, NULL)");
        }
        if (!empty($sql)){
            return true;
        } else {
            return false;
        }
    }
    
    function checkIfTableEmpty($moments){
        $table = mysqli_query($this->conn, "SELECT (id) FROM moments");
        if(mysqli_num_rows($table) > 0) {
            return true;
        } else {
            $result = $this->storeMomentsInTable($moments);
            return $result;
        }
        
    }
    
        
    function checkIfDateAvaible(){
        $currentDateTime = date('Y-m-d H:i:s');
        $query =  mysqli_query($this->conn,"SELECT * FROM moments");
        $fetchedData = mysqli_fetch_all($query, MYSQLI_ASSOC);
        
        foreach ($fetchedData as $data) {
            $resulting_time = $data["resulting_time"];
            if(empty($data["date_assignment"])){
                if ($resulting_time < $currentDateTime) {
                    $uniqueId = uniqid();
                    $uniqueId = hexdec(substr($uniqueId, 0, 8));
                    $sql = mysqli_query($this->conn, "UPDATE moments SET id_user = '$uniqueId', date_assignment = '$currentDateTime' WHERE resulting_time = '$resulting_time'");
                    
                }
            }
        }
            if (!empty($sql)){
                return true;
            } else {
                return false;
            }
        }
    
}