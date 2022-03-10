<?php
	
	include_once __DIR__ . '/../util/custom_exception.php';
	
	class Admin {
		
		// Connection
		public $conn;
		
		// Table
		private $db_table = "admin";
		
		public $id;
		public $name;
		public $email;
		public $role;
		public $access;
		public $image;
		public $phone;
		public $password;
		
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
		
		// GET ALL Search
		public function getAdminSearch($data) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE name LIKE '%$data%' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// check exist data by email
		public function checkExistAdmin($email) {
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
		
		// UPDATE Forgot password
		public function changePassword($new_password,$email) {
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
		
		// UPDATE Admin
		public function update($data, $id)
		: bool {
			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        name = :name,
                        role = :role,
                        access = :access,
                        phone = :phone,
                        image = :image
                    WHERE
                        id = $id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":name", $data->name);
			$stmt->bindParam(":role", $data->role);
			$stmt->bindParam(":access", $data->access);
			$stmt->bindParam(":phone", $data->phone);
			$stmt->bindParam(":image", $data->image);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// GET ALL
		public function get() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		public function getAllAdmin() {
			$sqlQuery = "SELECT *
							FROM
							    " . $this->db_table . "
							WHERE
								role = 'admin' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		public function getAllSuperAdmin() {
			$sqlQuery = "SELECT *
							FROM
							    " . $this->db_table . "
							WHERE
								role = 'superAdmin' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// READ single
		public function getById($id) {
			$sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = $id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			
			return $stmt;
		}
		
		// READ single by email
		
		/**
		 * @throws CustomException
		 */
		public function getByEmail($email) {
			$sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE
                       email = :email";
			
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
			
			if ($stmt->rowCount() == 0) {
				throw new CustomException("email", "Please register from this email first.");
			} else {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->id = $row['id'];
				$this->name = $row['name'];
				$this->email = $row['email'];
				$this->role = $row['role'];
				$this->access = $row['access'];
				$this->phone = $row['phone'];
				$this->image = $row['image'];
				$this->password = $row['password'];
			}
			
			return $this;
		}
		
		
		// UPDATE Profile
		public function updateProfile($data,$id)
		 {
			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        name = :name,
                        email = :email,
                        phone = :phone,
                        image = :image
                    WHERE
                        id = $id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":name", $data->name);
			$stmt->bindParam(":email", $data->email);
			$stmt->bindParam(":phone", $data->phone);
			$stmt->bindParam(":image", $data->image);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// UPDATE Profile Password
		public function updatePassword($new_password,$id) {
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
		
		
		// UPDATE ACTIVE STATUS
		public function updateStatus() {
			$sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        active_status = :active_status 
                    WHERE 
                        category_id = :category_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":active_status", $this->active_status);
			$stmt->bindParam(":category_id", $this->category_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// DELETE
		function delete($id)
		: bool {
			$sqlQuery = "DELETE
							FROM
							     " . $this->db_table . "
							WHERE id = :id";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(":id", $id);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
	}
