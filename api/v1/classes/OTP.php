<?php
    class OTP{

        // Connection
        private $conn;

        // Table
        private $db_table = "otp";

      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	
	    // save
	    public function save($code,$email,$created_at, $expired_at){
		    $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        email = :email,
                        code = :code,
                        created_at = :created_at,
                        expired_at = :expired_at";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":code", $code);
		    $stmt->bindParam(":email", $email);
		    $stmt->bindParam(":created_at", $created_at);
		    $stmt->bindParam(":expired_at", $expired_at);
		
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
		
//		Get OTP code
	    public function getOTP($data) {
		    $sqlQuery = "SELECT * FROM ".$this->db_table." WHERE code=:code AND email=:email";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->bindParam(":code", $data->otp_code);
		    $stmt->bindParam(":email", $data->email);
		    $stmt->execute();
		    return $stmt;
	    }
		
		//		Get OTP code
	    public function getOTPforAdmin($code, $email) {
		    $sqlQuery = "SELECT * FROM ".$this->db_table." WHERE code=:code AND email=:email";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->bindParam(":code", $code);
		    $stmt->bindParam(":email", $email);
		    $stmt->execute();
		    return $stmt;
	    }
		
//		if email exist
	    public function checkByEmail($email) {
		    $sqlQuery = "SELECT * FROM ".$this->db_table." WHERE email = :email ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->bindParam(":email", $email);
		    $stmt->execute();
		    return $stmt;
	    }
		
//		if email exist
	    public function delete($email) {
		    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE email = :email ";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(":email", $email);
		
		    if ($stmt->execute()) {
			    return true;
		    }
		    return false;
	    }
		
	

    }