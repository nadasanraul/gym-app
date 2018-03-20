<?php
    require_once('config/db.php');

    class Users {
        private $name;
        private $email;
        private $password;
        private $query;

        public function register(){
            $conn = new Db;
            $link = $conn->dbConnect();

            if(isset($_POST['submit'])){
                $query = 'SELECT email FROM users WHERE email = ?';
                $stmt = $link->prepare($query);
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
                if(count($row) > 0){
                    $_SESSION['message'] = 'User already exists';
                    header('Location: register.php');
                    exit();
                }
                if($_POST['password'] == $_POST['confirm_password']){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = hash('sha256', $_POST['password']);
                    $query = 'INSERT INTO users(name, email, password) VALUES(?, ?, ?)';
                    $stmt = $link->prepare($query);
                    $stmt->bind_param('sss', $name, $email, $password);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'] = 'You are registered. You can login now';
                    header('Location: login.php');
                    exit();
                } else if($_POST['password'] != $_POST['confirm_password']) {
                    $_SESSION['message'] = 'Passwords do not match';
                    header('Location: register.php');
                    exit();
                }
            }
        }

        public function login(){
            $conn = new Db;
            $link = $conn->dbConnect();

            if(isset($_POST['submit'])){
                $email = $_POST['email'];            
                $password = hash('sha256', $_POST['password']);

                $query = 'SELECT * FROM users WHERE email = ?';
                $stmt = $link->prepare($query);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($row['password'] == $password){
                    $_SESSION['name'] = $row['name'];
                    $_SESION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                    header('Location: index.php');
                    exit();
                } 
                else if(count($row) == 0 ) {
                    $_SESSION['message'] = 'No user found';
                    header('Location: login.php');
                    exit();
                } 
                else {
                    $_SESSION['message'] = 'Incorect Password';
                    header('Location: login.php');
                    exit();
                }
                
            }
        }

    }