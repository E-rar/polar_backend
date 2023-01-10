<?php
    class Entry{
        // Connection
        private $conn;
        // Table
        private $db_table = "polar";
        // Columns
        public $id;
        public $topic;
        public $body;
        public $epic;
        public $color;
        public $asignee;
        public $argument;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEntrys(){
            $sqlQuery = "SELECT id, topic, body, epic, color, asignee, argument  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createEntry(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        topic = :topic, 
                        body = :body, 
                        epic = :epic, 
                        color = :color, 
                        asignee = :asignee,
                        argument = :argument";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->topic=htmlspecialchars(strip_tags($this->topic));
            $this->body=htmlspecialchars(strip_tags($this->body));
            $this->epic=htmlspecialchars(strip_tags($this->epic));
            $this->color=htmlspecialchars(strip_tags($this->color));
            $this->asignee=htmlspecialchars(strip_tags($this->asignee));
            $this->argument=htmlspecialchars(strip_tags($this->argument));
            // bind data
            $stmt->bindParam(":topic", $this->topic);
            $stmt->bindParam(":body", $this->body);
            $stmt->bindParam(":epic", $this->epic);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":asignee", $this->asignee);
            $stmt->bindParam(":argument", $this->argument);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleEntry(){
            $sqlQuery = "SELECT
                        id, 
                        topic, 
                        body, 
                        epic, 
                        color, 
                        asignee,
                        argument
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->topic = $dataRow['topic'];
            $this->body = $dataRow['body'];
            $this->epic = $dataRow['epic'];
            $this->color = $dataRow['color'];
            $this->asignee = $dataRow['asignee'];
            $this->argument = $dataRow['argument'];
        }        
        // UPDATE
        public function updateEntry(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        topic = :topic, 
                        body = :body, 
                        epic = :epic, 
                        color = :color, 
                        asignee = :asignee,
                        argument = :argument
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->topic=htmlspecialchars(strip_tags($this->topic));
            $this->body=htmlspecialchars(strip_tags($this->body));
            $this->epic=htmlspecialchars(strip_tags($this->epic));
            $this->color=htmlspecialchars(strip_tags($this->color));
            $this->asignee=htmlspecialchars(strip_tags($this->asignee));
            $this->argument=htmlspecialchars(strip_tags($this->argument));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":topic", $this->topic);
            $stmt->bindParam(":body", $this->body);
            $stmt->bindParam(":epic", $this->epic);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":asignee", $this->asignee);
            $stmt->bindParam(":argument", $this->argument);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEntry(){
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