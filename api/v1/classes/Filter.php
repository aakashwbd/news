<?php
    class Filter{

        // Connection
        private $conn;

        // Table
        private $db_radio = "radio";
        private $db_country = "countries";
        private $db_language = "language";

        // Columns
		public $category;
		public $country;
		public $languages;
		
		public $radio_id;
		public $country_id;
		public $radio_name;
		
    

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
		
		

        // GET ALL Radio which are free and specific country
        public function getRadioByCategory(){
            $sqlQuery = "SELECT *
					FROM
              			" . $this->db_radio . "
              		INNER JOIN
              		    " . $this->db_country . "
              		ON
              		    " . $this->db_radio . ".country_id = " . $this->db_country . ".country_id
              		INNER JOIN
              		    " . $this->db_language . "
              		ON
              		    " . $this->db_radio . ".language_id = " . $this->db_language . ".language_id
              		WHERE
              		    radio_category = ?";
			
	        $stmt = $this->conn->prepare($sqlQuery);
	
	        $stmt->bindParam(1, $this->category);
	
	        $stmt->execute();
			
			
	
	        return $stmt;
        }
		
		// GET ALL Radio By specific country
        public function bySpecificCountry(){
            $sqlQuery = "SELECT *
					FROM
              			" . $this->db_radio . "
              		INNER JOIN
              		    " . $this->db_country . "
              		ON
              		    " . $this->db_radio . ".country_id = " . $this->db_country . ".country_id
              		INNER JOIN
              		    " . $this->db_language . "
              		ON
              		    " . $this->db_radio . ".language_id = " . $this->db_language . ".language_id
              		WHERE
              		    " . $this->db_radio . ".country_id = ?";
			
	        $stmt = $this->conn->prepare($sqlQuery);
	
	        $stmt->bindParam(1, $this->country);
	
	        $stmt->execute();
			
	        return $stmt;
        }
		
		// GET ALL Radio By specific Languages
        public function bySpecificLanguage(){
            $sqlQuery = "SELECT *
					FROM
              			" . $this->db_radio . "
              		INNER JOIN
              		    " . $this->db_country . "
              		ON
              		    " . $this->db_radio . ".country_id = " . $this->db_country . ".country_id
              		INNER JOIN
              		    " . $this->db_language . "
              		ON
              		    " . $this->db_radio . ".language_id = " . $this->db_language . ".language_id
              		WHERE
              		    " . $this->db_radio . ".language_id = ?";
			
	        $stmt = $this->conn->prepare($sqlQuery);
	
	        $stmt->bindParam(1, $this->languages);
	
	        $stmt->execute();
			
	        return $stmt;
        }
		
		//GET All Radio
	    public function getRadioByCategoryAll(){
		    $sqlQuery = "SELECT *
							FROM
						     	". $this->db_radio ."
						    INNER JOIN
						        ". $this->db_language ."
						    ON
						        ". $this->db_radio .".language_id = ". $this->db_language .".language_id
						    INNER JOIN
						        ". $this->db_country ."
						    ON ". $this->db_radio .".country_id = ". $this->db_country .".country_id";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    }
	
	    //GET Radio By Category Not Equal All & Country Not Equal All
	    public function byCategoryNCountry(){
		    $sqlQuery = "SELECT *
							FROM
						     	". $this->db_radio ."
						    INNER JOIN
						        ". $this->db_language ."
						    ON
						        ". $this->db_radio .".language_id = ". $this->db_language .".language_id
						    INNER JOIN
						        ". $this->db_country ."
						    ON ". $this->db_radio .".country_id = ". $this->db_country .".country_id
						    WHERE radio_category = :radio_category AND ". $this->db_radio .".country_id = :country_id ";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(':radio_category', $this->category);
		    $stmt->bindParam(':country_id', $this->country);
		    $stmt->execute();
		    return $stmt;
	    }
		
		//GET Radio By Category Not Equal All & Country Not Equal All
	    public function byCategoryNLanguage(){
		    $sqlQuery = "SELECT *
							FROM
						     	". $this->db_radio ."
						    INNER JOIN
						        ". $this->db_language ."
						    ON
						        ". $this->db_radio .".language_id = ". $this->db_language .".language_id
						    INNER JOIN
						        ". $this->db_country ."
						    ON ". $this->db_radio .".country_id = ". $this->db_country .".country_id
						    WHERE radio_category = :radio_category AND ". $this->db_radio .".language_id = :language_id ";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(':radio_category', $this->category);
		    $stmt->bindParam(':language_id', $this->languages);
		    $stmt->execute();
		    return $stmt;
	    }
		
		//GET Radio By Category, Country & Language not equal All
	    public function byCategoryCountryLanguage(){
		    $sqlQuery = "SELECT *
							FROM
						     	". $this->db_radio ."
						    INNER JOIN
						        ". $this->db_language ."
						    ON
						        ". $this->db_radio .".language_id = ". $this->db_language .".language_id
						    INNER JOIN
						        ". $this->db_country ."
						    ON
						        ". $this->db_radio .".country_id = ". $this->db_country .".country_id
						    WHERE
						        radio_category = :radio_category
						    AND
						        ". $this->db_radio .".country_id = :country_id
						    AND
						       ". $this->db_radio .".language_id = :language_id";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(':radio_category', $this->category);
		    $stmt->bindParam(':country_id', $this->country);
		    $stmt->bindParam(':language_id', $this->languages);
		    $stmt->execute();
		    return $stmt;
	    }
		

    
	

    }