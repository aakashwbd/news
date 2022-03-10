<?php
    class Radio{

        // Connection
        private $conn;

        // Table
        private $db_table = "radio";
        private $db_table_language = "language";
        private $db_table_country = "countries";
       

        // Columns
        public $radio_id;
        public $language_id;
        public $language_name;
        public $country_id;
        public $country_name;
        public $country_flag;
        public $radio_category;
        public $radio_name;
        public $radio_frequency;
        public $radio_url;
        public $radio_description;
        public $radio_image;
        public $radio_status;
        public $created_at;
        public $updated_at;
   
    

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getRadio(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ." INNER JOIN ". $this->db_table_language ." ON ". $this->db_table .".language_id = ". $this->db_table_language .".language_id INNER JOIN ". $this->db_table_country ." ON ". $this->db_table .".country_id = ". $this->db_table_country .".country_id";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
		
		
		// GET Radio By Country ALL
        public function getByCountry($id){
            $sqlQuery = "SELECT *
							FROM
							     ". $this->db_table ."
							INNER JOIN
								". $this->db_table_language ."
							ON
								". $this->db_table .".language_id = ". $this->db_table_language .".language_id
							INNER JOIN
								". $this->db_table_country ."
							ON
								". $this->db_table .".country_id = ". $this->db_table_country .".country_id
							WHERE
								". $this->db_table .".country_id = $id ";
	        
            $stmt = $this->conn->prepare($sqlQuery);
	        $stmt->execute();
	        
	        return $stmt;
        }
		
		// GET Radio By Language ALL
        public function getByLanguage($id){
            $sqlQuery = "SELECT *
							FROM
							     ". $this->db_table ."
							INNER JOIN
								". $this->db_table_language ."
							ON
								". $this->db_table .".language_id = ". $this->db_table_language .".language_id
							INNER JOIN
								". $this->db_table_country ."
							ON
								". $this->db_table .".country_id = ". $this->db_table_country .".country_id
							WHERE
								". $this->db_table .".language_id = $id ";
	        
            $stmt = $this->conn->prepare($sqlQuery);
	        $stmt->execute();
	        
	        return $stmt;
        }

        // CREATE
        public function createRadio(){
            $sqlQuery = "INSERT INTO ". $this->db_table ."
                    SET
                        country_id = :country_id,
                        language_id = :language_id,
                        radio_category = :radio_category,
                        radio_name = :radio_name,
                        radio_frequency = :radio_frequency,
                        radio_url = :radio_url,
                        radio_description = :radio_description,
	                    radio_image = :radio_image";
        
            $stmt = $this->conn->prepare($sqlQuery);

        
            // sanitize
            $this->language_id = htmlspecialchars(strip_tags($this->language_id));
            $this->country_id = htmlspecialchars(strip_tags($this->country_id));
            $this->radio_category = htmlspecialchars(strip_tags($this->radio_category));
            $this->radio_name = htmlspecialchars(strip_tags($this->radio_name));
            $this->radio_frequency = htmlspecialchars(strip_tags($this->radio_frequency));
            $this->radio_url = htmlspecialchars(strip_tags($this->radio_url));
            $this->radio_description = htmlspecialchars(strip_tags($this->radio_description));

            // bind data
            $stmt->bindParam(':language_id', $this->language_id);
            $stmt->bindParam(':country_id', $this->country_id);
            $stmt->bindParam(':radio_category', $this->radio_category);
            $stmt->bindParam(':radio_name', $this->radio_name);
            $stmt->bindParam(':radio_frequency', $this->radio_frequency);
            $stmt->bindParam(':radio_url', $this->radio_url);
            $stmt->bindParam(':radio_description', $this->radio_description);
            $stmt->bindParam(':radio_image', $this->radio_image);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleRadio(){

            $sqlQuery = "SELECT * FROM ". $this->db_table ." INNER JOIN ". $this->db_table_language ." ON ". $this->db_table .".language_id = ". $this->db_table_language .".language_id INNER JOIN ". $this->db_table_country ." ON ". $this->db_table .".country_id = ". $this->db_table_country .".country_id
                    WHERE 
                        radio_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);
			
            $stmt->bindParam(1, $this->radio_id);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->radio_id = $dataRow['radio_id'];
			
	        $this->country_id = $dataRow['country_id'];
			$this->country_name = $dataRow['country_name'];
			$this->country_flag = $dataRow['country_flag'];
			
            $this->language_id = $dataRow['language_id'];
            $this->language_name = $dataRow['language_name'];
            
            $this->radio_category = $dataRow['radio_category'];
            $this->radio_name = $dataRow['radio_name'];
            $this->radio_frequency = $dataRow['radio_frequency'];
            $this->radio_url = $dataRow['radio_url'];
            $this->radio_description = $dataRow['radio_description'];
            $this->radio_image = $dataRow['radio_image'];
            $this->radio_status = $dataRow['radio_status'];

        }        

        // UPDATE Country without image
        public function updateRadio(){
            $sqlQuery = "UPDATE ".$this->db_table." 
                    SET
                        country_id = :country_id,
                        language_id = :language_id,
                        radio_category = :radio_category,
                        radio_name = :radio_name,
                        radio_frequency = :radio_frequency,
                        radio_url = :radio_url,
                        radio_description = :radio_description,
	                    radio_image = :radio_image
                    WHERE 
                        radio_id = :radio_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
	
	        // sanitize
	        $this->language_id = htmlspecialchars(strip_tags($this->language_id));
	        $this->country_id = htmlspecialchars(strip_tags($this->country_id));
	        $this->radio_category = htmlspecialchars(strip_tags($this->radio_category));
	        $this->radio_name = htmlspecialchars(strip_tags($this->radio_name));
	        $this->radio_frequency = htmlspecialchars(strip_tags($this->radio_frequency));
	        $this->radio_url = htmlspecialchars(strip_tags($this->radio_url));
	        $this->radio_description = htmlspecialchars(strip_tags($this->radio_description));
	        $this->radio_id = htmlspecialchars(strip_tags($this->radio_id));
	
	        // bind data
	        $stmt->bindParam(':language_id', $this->language_id);
	        $stmt->bindParam(':country_id', $this->country_id);
	        $stmt->bindParam(':radio_category', $this->radio_category);
	        $stmt->bindParam(':radio_name', $this->radio_name);
	        $stmt->bindParam(':radio_frequency', $this->radio_frequency);
	        $stmt->bindParam(':radio_url', $this->radio_url);
	        $stmt->bindParam(':radio_description', $this->radio_description);
	        $stmt->bindParam(':radio_image', $this->radio_image);
	        $stmt->bindParam(':radio_id', $this->radio_id);

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
                        radio_status = :radio_status
                    WHERE 
                        radio_id = :radio_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
           
            // bind data
            $stmt->bindParam(":radio_status", $this->radio_status);
            $stmt->bindParam(":radio_id",  $this->radio_id);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }
		

        // DELETE
        function deleteRadio(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE radio_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->radio_id=htmlspecialchars(strip_tags($this->radio_id));
        
            $stmt->bindParam(1, $this->radio_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
		
		//	last day count
	    public function lastCount(){
		   
		   $sql = "SELECT *
						FROM
		   					". $this->db_table ."
		   				WHERE
		   				    created_at BETWEEN CURDATE()-7 AND CURDATE()";
		
		    $stmt = $this->conn->prepare( $sql);
		    $stmt->execute();
		    return $stmt;
	    }

    }
