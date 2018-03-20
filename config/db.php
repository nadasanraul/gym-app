<?php
    require_once('config/config.php');

    class Db extends mysqli {
        private $conn;
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pwd = DB_PWD;
        private $name = DB_NAME;

        public function dbConnect(){
            $conn = new mysqli($this->host, $this->user, $this->pwd, $this->name);

            if($conn->connect_error){
                die('Connection error: '.$mysqli->connect_errno);
            }
            return $conn;
        }
    }
  