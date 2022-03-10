<?php
	
	include_once __DIR__ . '/../util/custom_exception.php';
	
	class Dashboard {
		
		// Connection
		public $conn;
		
		// Table
		private $db_table = "manage-admin";
		
	
		
		// Db connection
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// save
		public function save($data)
		: bool {
			$sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        name = :name,
                        email = :email,
                        role = :role,
                        access = :access,
                        phone = :phone,
                        image = :image,
                        password = :password";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$password_hash= md5($data->password);
			$access = json_encode($data->access);
			
			// bind data
			$stmt->bindParam(":name", $data->name);
			$stmt->bindParam(":email", $data->email);
			$stmt->bindParam(":role", $data->role);
			$stmt->bindParam(":access", $access);
			$stmt->bindParam(":phone", $data->phone);
			$stmt->bindParam(":image", $data->image);
			$stmt->bindParam(":password", $password_hash);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
	}
