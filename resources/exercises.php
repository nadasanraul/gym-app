<?php
    require_once('config/db.php');

    class Exercises {
        private $query;

        public function selectExercises(){
            $query = 'SELECT * FROM exercises';
            
            $conn = new Db;
            $link = $conn->dbConnect();
            
            $stmt = $link->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function selectExercise($id){
            $conn = new Db;
            $link = $conn->dbConnect();

            $query = "SELECT * FROM exercises WHERE id = ?";

            $stmt = $link->prepare($query);
            $stmt->bind_param('d', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->fetch_array(MYSQLI_ASSOC);
        }

        public function getSets($id){
            $conn = new Db;
            $link = $conn->dbConnect();
            $date = date('Y-m-d').'%';

            $query = 'SELECT * FROM sets WHERE exerc_id = ? AND created_at LIKE ?';

            $stmt = $link->prepare($query);
            $stmt->bind_param('ds', $id, $date);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function addNew(){
            if(isset($_POST['submit'])){
                $conn = new Db;
                $link = $conn->dbConnect();

                $name = $link->real_escape_string($_POST['name']);
                $type = $link->real_escape_string($_POST['type']);
                $category = $link->real_escape_string($_POST['category']);

                $query = "INSERT INTO exercises (name, type, worked_muscles) VALUES(?, ? ,?)";
                $stmt = $link->prepare($query);
                $stmt->bind_param('sss', $name, $type, $category);
                $stmt->execute();
                $stmt->close();
                header('Location: index.php');
            }
        }

        public function newSet(){
            if(isset($_POST['submit'])){
                $conn = new Db;
                $link = $conn->dbConnect();

                $weight = $link->real_escape_string($_POST['weight']);
                $reps = $link->real_escape_string($_POST['reps']);
                $exerc_id = $link->real_escape_string($_POST['exerc_id']);

                $query = 'INSERT INTO sets (exerc_id, weight, reps) VALUES(?, ? ,?)';

                $stmt = $link->prepare($query);
                $stmt->bind_param('ddd', $exerc_id, $weight, $reps);
                $stmt->execute();
                $stmt->close();
                header('Location: show.php?id='.$exerc_id);
            }
        }

        public function getWorkouts($date){
            $conn = new Db;
            $link = $conn->dbConnect();

            $nextDay = date('Y-m-d', strtotime($date.'+1 day'));

            $query = "SELECT 
                        sets.exerc_id, sets.weight, sets.reps, sets.created_at, exercises.id, exercises.name FROM sets
                        INNER JOIN exercises
                      WHERE sets.created_at BETWEEN ? AND ?
                        AND sets.exerc_id = exercises.id
                      ORDER BY exerc_id";
            $stmt = $link->prepare($query);
            $stmt->bind_param('ss', $date, $nextDay);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }  
        
        public function getNames($date){
            $conn = new Db;
            $link = $conn->dbConnect();

            $nextDay = date('Y-m-d', strtotime($date.'+1 day'));

            $query = "SELECT 
                        exercises.name FROM sets
                        INNER JOIN exercises
                    WHERE sets.created_at BETWEEN ? AND ?
                        AND sets.exerc_id = exercises.id
                    ORDER BY sets.created_at ASC";
            $stmt = $link->prepare($query);
            $stmt->bind_param('ss', $date, $nextDay);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $result = array_unique($result, SORT_REGULAR);
            return $result;
        }
    }