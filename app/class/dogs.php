<?php
    class Dog{

        // Connection
        private $conn;

        // Table
        private $db_table = "Dog";

        // Columns
        public $id;
        public $name;
        public $owner;
        public $age;
        public $breed;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDogs(){
            $sqlQuery = "SELECT id, name, owner, age, breed FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createDog(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        owner = :owner, 
                        age = :age, 
                        breed = :breed";
            $stmt = $this->conn->prepare($sqlQuery);
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->owner=htmlspecialchars(strip_tags($this->owner));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->breed=htmlspecialchars(strip_tags($this->breed));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":owner", $this->owner);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":breed", $this->breed);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleDog(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        owner  , 
                        age, 
                        breed, 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->owner = $dataRow['owner'];
            $this->age = $dataRow['age'];
            $this->breed = $dataRow['breed'];
        }        

        // UPDATE
        public function updateDog(){

            $sqlQuery = "UPDATE
                        ".$this->db_table ."
                    SET
                        name = :name, 
                        owner = :owner, 
                        age = :age, 
                        breed = :breed 
                  
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->owner=htmlspecialchars(strip_tags($this->owner));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->breed=htmlspecialchars(strip_tags($this->breed));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":owner", $this->owner);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":breed", $this->breed);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteDog(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

