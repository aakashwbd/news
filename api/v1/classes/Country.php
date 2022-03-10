<?php
    class Country{

        // Connection
        private $conn;

        // Table
        private $db_table = "countries";

        // Columns
        public $country_id;
        public $country_name;
        public $country_flag;
        public $country_status;
        public $created_at;
        public $updated_at;
    

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAllCountry(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCountry(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        country_name = :country_name,
                        country_flag = :country_flag";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->country_name=htmlspecialchars(strip_tags($this->country_name));
         
         
        
            // bind data
            $stmt->bindParam(":country_name", $this->country_name);
            $stmt->bindParam(":country_flag", $this->country_flag);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
	
	    //  CHECK Exist data
	    public function checkCountry() {
		    $selectQuery = "SELECT * FROM " . $this->db_table . "
                             WHERE
                                 country_name = ? LIMIT 0, 1";
		    $stmt = $this->conn->prepare($selectQuery);
		
		    // sanitize
		    $this->country_name = htmlspecialchars(strip_tags($this->country_name));
		
		
		    // bind data
		    $stmt->bindParam(1, $this->country_name);
		
		    $stmt->execute();
		
		    // get number of rows
		    $num = $stmt->rowCount();
		
		    // if name exists, assign values to object properties for easy access and use for php sessions
		    if ($num > 0) {
			
			    // get record details / values
			    $row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			    // assign values to object properties
			    $this->country_id = $row['country_id'];
			    $this->country_name = $row['country_name'];
			    $this->country_status = $row['country_status'];
			
			    // return true because name exists in the database
			    return true;
		    }
		
		    // return false if name does not exist in the database
		    return false;
	    }

        // READ single
        public function getSingleCountry(){
            $sqlQuery = "SELECT *
					FROM
                        ". $this->db_table ."
                    WHERE 
                       country_id = ?";
            
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->country_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
            $this->country_id = $dataRow['country_id'];
            $this->country_name = $dataRow['country_name'];
            $this->country_flag = $dataRow['country_flag'];
            $this->country_status = $dataRow['country_status'];

        }        

        // UPDATE Country
        public function updateCountry(){
            $sqlQuery = "UPDATE ".$this->db_table." 
                    SET
                        country_name = :country_name,
                        country_flag = :country_flag
                    WHERE 
                        country_id = :country_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
	
	        // sanitize
	        $this->country_name = htmlspecialchars(strip_tags($this->country_name));
	        $this->country_id = htmlspecialchars(strip_tags($this->country_id));

            // bind data
           $stmt->bindParam(':country_name', $this->country_name);
           $stmt->bindParam(':country_flag', $this->country_flag);
           $stmt->bindParam(':country_id', $this->country_id);

            if($stmt->execute()){
               return true;
            }
            return false; 
        }
        
   

        // UPDATE ACTIVE STATUS
        public function updateStatus(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        country_status = :country_status
                    WHERE 
                        country_id = :country_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
            
        
            // bind data
            $stmt->bindParam(":country_status", $this->country_status);
            $stmt->bindParam(":country_id",  $this->country_id);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // DELETE
        public function deleteCountry(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE country_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->country_id=htmlspecialchars(strip_tags($this->country_id));
        
            $stmt->bindParam(1, $this->country_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }