<?php
	
	class User {
		
		// Connection
		private $conn;
		
		// Table
		private $db_table = "users";
		
		
		// Db connection
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// GET ALL
		public function getUsers() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// CREATE
		public function save($data) {
			$sqlQuery = "INSERT INTO " . $this->db_table . "
                    SET
                        name = :name,
                        email = :email,
                        phone = :phone,
                        password = :password,
                        image = :image";
			
			$stmt = $this->conn->prepare($sqlQuery);
			$password_hash = md5($data->password);
			// bind data
			$stmt->bindParam(":name", $data->name);
			$stmt->bindParam(":email", $data->email);
			$stmt->bindParam(":phone", $data->phone);
			$stmt->bindParam(":password", $password_hash);
			$stmt->bindParam(":image", $data->image);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		// GET ALL Search
		public function getSearch($data) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE name LIKE '%$data%' OR phone LIKE '%$data%' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		public function getEmail($email) {
			$sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE
                       email = :email";
			
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
			
			return $stmt;
		}
		
		
		public function getByEmail($email) {
			$sqlQuery = "SELECT *
							FROM
							     " . $this->db_table . "
                            WHERE
                                email = :email";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":email", $email);
			
			$stmt->execute();
			
			$num = $stmt->rowCount();
			
			if ($num > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $row['id'];
				$name = $row['name'];
				$email = $row['email'];
				$phone = $row['phone'];
				$password = $row['password'];
				$image = $row['image'];
				
				return true;
			}
			return false;
		}
		
		public function passwordByEmail($email) {
			$sqlQuery = "SELECT *
							FROM
							     " . $this->db_table . "
                            WHERE
                                email = :email";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":email", $email);
			
			$stmt->execute();
			return $stmt;
		}
		
		// READ single
		public function getSingleUser($id) {
			$sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			$stmt->execute();
			return $stmt;
		}
		
		// UPDATE User
		public function update($data, $id) {
			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        name = :name,
                        phone = :phone,
                        image = :image
                    WHERE
                        id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// bind data
			$stmt->bindParam(":name", $data->name);
			$stmt->bindParam(":phone", $data->phone);
			$stmt->bindParam(":image", $data->image);
			
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// UPDATE User
		public function show($id) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . "
                WHERE id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// bind data
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt;
		}
		
		
		public function updatePassword($new_password, $id) {
			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        password = :password
                    WHERE
                        id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":password", $new_password);
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		//	forgot password
		public function changePassword($new_password, $email) {
			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        password = :password
                    WHERE
                        email = :email ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":password", $new_password);
			$stmt->bindParam(":email", $email);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// DELETE
		function deleteUser($id) {
			$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(":id", $id);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
	}
