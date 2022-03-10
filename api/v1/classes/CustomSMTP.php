<?php
    class CustomSMTP{

        // Connection
        private $conn;

        // Table
        private $db_table = "smtp";

      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	
	    // save
	    public function save($data){
		    $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        host = :host,
                        port = :port,
                        username = :username,
                        password = :password,
                        encryption= :encryption";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":host", $data->host);
		    $stmt->bindParam(":port", $data->port);
		    $stmt->bindParam(":username", $data->username);
		    $stmt->bindParam(":password", $data->password);
		    $stmt->bindParam(":encryption", $data->encryption);
		
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
	
	    // GET ALL
	    public function getSMTP() {
		    $sqlQuery = "SELECT * FROM ".$this->db_table." ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    }
		

	

        // UPDATE CATEGORY
	    public function update($data) {
		    $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        host = :host,
                        port = :port,
                        username = :username,
                        password = :password,
                        encryption= :encryption";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":host", $data->host);
		    $stmt->bindParam(":port", $data->port);
		    $stmt->bindParam(":username", $data->username);
		    $stmt->bindParam(":password", $data->password);
		    $stmt->bindParam(":encryption", $data->encryption);
			
		    if ($stmt->execute()) {
			    return true;
		    }
		    return false;
	    }




    }