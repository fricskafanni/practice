<?php
require_once __DIR__ . '/../models/connection.php';    
require_once __DIR__ . '/../models/Log.class.php';

class User 
{
    private $db;
    private $error;
    private $dataLog;
    
    function __construct() {
        $this->db = new MyDBClass;
        $this->dataLog = new LogClass;
    
    }
    
    function isLoggedIn() {
        if (!empty($_SESSION['user'])){
            return true;
        } else {
            return false;
        }
    }
    
    function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $functionName = 'login';

        $response = $this->db->getUser($email, $password);

        $error = $this->error = $response['error'];
        $message = $this->message = $response['message'];
        
        $fopen = $this->dataLog->logData($functionName, $message);
        
        if ($error == 1){
            return array('error' => $error, 'message' => $message);
        }else {
            $_SESSION['user'] = $message;
            //var_dump($_SESSION['user']['role']);
            return array('error' => $error, 'message' => $_SESSION['user']['role']);
        }
    }
    
    function logout() {
        $functionName = 'logout';
        //$message = $_SESSION['user'];
        
        //$fopen = $this->dataLog->logData($functionName, $message);
        unset($_SESSION['user']);
    }
    
    function get()
    {
        if (!$this->isLoggedIn())
            return FALSE;
            
        return $_SESSION['user'];
    }
    
    function update()
    {
        $this->error = '';
        $email = $_POST['email'];
        $password = $_POST['password'];  
        $name = $_POST['name'];  
        $lastname = $_POST['lastname'];  
        $dob = implode('-', array_reverse(explode('/', $_POST['dob'])));  
        
        if(!$this->isLoggedIn())
            return FALSE;
        
        $response = $this->db->update($email, $password, $name, $lastname, $dob);
        
            if(!empty($response['user'])) {
                $_SESSION['user'] = $response['user'];
                return $_SESSION['user']['role'];
            }
            else {
                $this->error = $response['error'];
                return FALSE;
            }
    }
    
    function listUsers(){
        $response = $this->db->getUsers();
        
        return $response;
    }
    
    function createUser(){
        
    }
    
    function deleteUser(){
        $userId = $_POST['userId'];
        
        $response = $this->db->deleteUser($userId);

        if(!empty($response)) {
            return TRUE;
        }
        else {
            $this->error = $response['error'];
            return FALSE;
        }
    }
    
    function getEditUser(){
        $userId = $_GET['id'];
        
        $response = $this->db->editUser($userId);
        if(!empty($response)) {
            return $response;
        }
        else {
            $this->error = $response['error'];
            return FALSE;
        }
    }
    
    function updateUserByAdmin()
    {
        $this->error = '';
        $id = $_POST['id'];
        $email = $_POST['email'];
        $name = $_POST['name'];  
        $lastname = $_POST['lastname'];  
        $dob = implode('-', array_reverse(explode('/', $_POST['dob'])));  
        $response = $this->db->updateUserData($id, $email, $name, $lastname, $dob);
        
            if($response) {
                return true;
            }
            else {
                $this->error = $response['error'];
                return FALSE;
            }
    }
        
    function updateUserPasswordByAdmin()
    {
        $this->error = '';
        $id = $_POST['id'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        
        $result = $this->db->getUserPassword($id, $password, $password1);
        
        if(!empty($result)) {
            $error = $this->error = $result['error'];
            $message = $this->message = $result['message'];
            return array('error' => $error, 'message' => $message);
        }
        else {
            return $this->error = $result['error'];
        }
    }
    
    
    function getError(){
        return $this->error;
    }
    
    function CreateNewUser(){
        
        $this->error = '';
        $email = $_POST['email'];
        $password = $_POST['password'];  
        //$name = $_POST['name'];  
        //$lastname = $_POST['lastname'];  
        //$dob = implode('-', array_reverse(explode('/', $_POST['dob'])));  
        $hash = md5($password);
        
        if(!$this->isLoggedIn())
            return FALSE;
        
        $response = $this->db->createUser($email, $hash);
            if(!empty($response)) {
                $error = $this->error = $response['error'];
                $message = $this->message = $response['message'];
                return array('error' => $error, 'message' => $message);
            }
            else {
                return $this->error = $result['error'];
            }
    }
}