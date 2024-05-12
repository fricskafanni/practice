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
        
        function getUser($email, $password)
        {
            $email = mysqli_real_escape_string($this->conn, $email);
            $password = md5(mysqli_real_escape_string($this->conn, $password));
            $select_email_query = mysqli_query($this->conn, "select * from users where email='$email'");
            
            if(mysqli_num_rows($select_email_query) > 0) {
                
                $select_query = mysqli_query($this->conn, "select * from users where email='$email' and pass='$password'");
       
                if(mysqli_num_rows($select_query) > 0) {
    
                    return array('error' => 0, 'message' => mysqli_fetch_array($select_query));
                }
                else
                {
                    return array('error' => 1, 'message' => 'The password is wrong!');
                }
            } else {
                return array('error' => 1, 'message' => 'This email doesnt exist in the database!');
            }

        }
        
        public function update($email, $password, $name, $lastname, $dob) {
            
            $email = mysqli_real_escape_string($this->conn, $email);
            $password = mysqli_real_escape_string($this->conn, $password);
            $name = mysqli_real_escape_string($this->conn, $name);
            $lastname = mysqli_real_escape_string($this->conn, $lastname);
            $dob = mysqli_real_escape_string($this->conn, $dob);
            $hash = md5($password);
            
            $update_query = mysqli_query($this->conn, 
                "UPDATE users SET 
                        pass='$hash', 
                        name='$name', 
                        lastname='$lastname', 
                        dob='$dob' 
                    WHERE email='$email'");
    
            if ($update_query) {
                //var_dump($_SESSION);
                return array('user' => $this->getUser($email, $password));
            } else {
                return array('error' => mysqli_error($this->conn));
            }
        }
                
        public function getUserPassword($id, $password, $password1) {
            
            $id = mysqli_real_escape_string($this->conn, $id);
            $previousPassword = md5(mysqli_real_escape_string($this->conn, $password));
            $newPassword = md5(mysqli_real_escape_string($this->conn, $password1));
            
            $select_query = mysqli_query($this->conn, 
                "select pass from users where id='$id'");
                
            $currentPassword = $select_query->fetch_assoc();
            $currentPassword = $currentPassword['pass'];

            if($previousPassword == $currentPassword) {
                
                $update_query = mysqli_query($this->conn, 
                "UPDATE users SET 
                        pass='$newPassword' 
                    WHERE id='$id'");
                    
                if ($update_query) {
                    return array('error' => 0, 'message' => '');
                } else {
                    return array('error' => mysqli_error($this->conn));
                }
            }else {
                return array('error' => 1, 'message' => 'The new passwords are equal to each other');
            }
        }   
        
        public function updateUserData($id, $email, $name, $lastname, $dob) {
            
            $email = mysqli_real_escape_string($this->conn, $email);
            $name = mysqli_real_escape_string($this->conn, $name);
            $lastname = mysqli_real_escape_string($this->conn, $lastname);
            $dob = mysqli_real_escape_string($this->conn, $dob);
            
            
            $update_query = mysqli_query($this->conn, 
                "UPDATE users SET 
                        email='$email',
                        name='$name', 
                        lastname='$lastname', 
                        dob='$dob' 
                    WHERE id='$id'");
            
            if ($update_query) {
                //var_dump($_SESSION);
                return TRUE;
            } else {
                return array('error' => mysqli_error($this->conn));
            }
        }
        
        public function getUsers(){
            $select_query = mysqli_query($this->conn, 
                "SELECT * FROM users WHERE role='user'");
                
            if(mysqli_num_rows($select_query) > 0) {
                //var_dump($_SESSION);
                
                return mysqli_fetch_all($select_query, MYSQLI_ASSOC);
            }
            else
            {
                return FALSE;
            }
        }
        
        public function deleteUser($userId){
            //var_dump($userEmail);
            $sql = "DELETE FROM users WHERE id='$userId'";
            //$response = $this->getUsers();
            
            if (mysqli_query($this->conn, $sql)) {
                return TRUE;

            } else {
                return FALSE;
            }
        }
        
        public function editUser($userId){
            $select_query = mysqli_query($this->conn, "select * from users where id='$userId'");
            
            if(mysqli_num_rows($select_query) > 0) {
                return mysqli_fetch_array($select_query);
            }
            else
            {
                return FALSE;
            }
        }
        
        public function createUser($email, $password, $name, $lastname, $dob){
            
            $select_query = mysqli_query($this->conn, "SELECT * from users where email = '$email'");
            
            if(mysqli_num_rows($select_query) > 0)
            {
                return array('error' => 1, 'message' => 'This user already exists with this email.');
                
            } else {
                $insert_query = mysqli_query($this->conn, 
                    "INSERT INTO users 
                    (`email`, `pass`, `name`, `lastname`, `dob`, `role`) 
                    VALUES ('$email', '$password', '$name', '$lastname', '$dob', 'user')"
                );
                return array('error' => 0, 'message' => '');
            }

        }
        
        
        /*
        public function isAdmin($email, $password){
            $email = mysqli_real_escape_string($this->conn, $email);
            $password = md5(mysqli_real_escape_string($this->conn, $password));
            
            $select_query = mysqli_query($this->conn, 
                "SELECT role FROM users WHERE email='$email' and pass='$password'");
                
            return mysqli_fetch_all($select_query);
        }*/

    }
    
    /*
            private function a()
        {
            return 'aaaa ' . $this->name;
        }

        protected function b()
        {
            return 'ooooo ' . $this->name;
        }

        public function c()
        {
            return $this->name;
        }
    }
    
    class nameOfClass2 extends nameOfClass
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->name = 'You';
        }
        
        public function d()
        {
            return $this->b();
        }
    $o = new nameOfClass2();
    
    //$o->b(); // error
    //$o->a(); // error
    echo $o->c();
    echo $o->d();
    
    $o1 = new nameOfClass();
    
    echo $o1->getUser('a@a.com', '1234');
    //$o1->b(); // error
    //$o1->a(); // error
    */

