<?php
	
	class Package {
		
		// Connection
		private $conn;
		
		
		// Table
		private $db_table = "packages";
		
		// Columns
		public $package_id;
		public $package_title;
		public $package_cost;
		public $package_duration;
		public $duration_type;
		public $package_description;
		public $package_status;
		public $created_at;
		public $updated_at;
		
		
		// Db connection
		
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// GET ALL
		        public function getPackage(){
		            $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
		            $stmt = $this->conn->prepare($sqlQuery);
		            $stmt->execute();
		            return $stmt;
		        }
		
		// CREATE
		public function createPackage() {
			$sqlQuery = "INSERT INTO " . $this->db_table . "
                    SET
                        package_title = :package_title,
                        package_cost = :package_cost,
                        package_duration = :package_duration,
                        duration_type = :duration_type,
                        package_description = :package_description ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// sanitize
			$this->package_title = htmlspecialchars(strip_tags($this->package_title));
			$this->package_cost = htmlspecialchars(strip_tags($this->package_cost));
			$this->package_description = htmlspecialchars(strip_tags($this->package_description));
			
			// bind data
			$stmt->bindParam(":package_title", $this->package_title);
			$stmt->bindParam(":package_cost", $this->package_cost);
			$stmt->bindParam(":package_duration", $this->package_duration);
			$stmt->bindParam(":duration_type", $this->duration_type);
			$stmt->bindParam(":package_description", $this->package_description);
			
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		//  CHECK Exist data
		public function checkPackage() {
			$selectQuery = "SELECT * FROM " . $this->db_table . "
                             WHERE
                                 package_title = ? LIMIT 0, 1";
			$stmt = $this->conn->prepare($selectQuery);
			
			// sanitize
			$this->package_title = htmlspecialchars(strip_tags($this->package_title));
			
			
			// bind data
			$stmt->bindParam(1, $this->package_title);
			
			$stmt->execute();
			
			// get number of rows
			$num = $stmt->rowCount();
			
			// if name exists, assign values to object properties for easy access and use for php sessions
			if ($num > 0) {
				
				// get record details / values
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				// assign values to object properties
				$this->package_id = $row['package_id'];
				$this->package_title = $row['package_title'];
				$this->package_cost = $row['package_cost'];
				$this->package_duration = $row['package_duration'];
				$this->duration_type = $row['duration_type'];
				$this->package_description = $row['package_description'];
				
				// return true because name exists in the database
				return true;
			}
			
			// return false if name does not exist in the database
			return false;
		}
		
		// READ single
		public function getSinglePackage() {
			$sqlQuery = "SELECT *
					FROM
                        " . $this->db_table . "
                    WHERE 
                       package_id = ?";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(1, $this->package_id);
			
			$stmt->execute();
			
			$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->package_id = $dataRow['package_id'];
			$this->package_title = $dataRow['package_title'];
			$this->package_cost = $dataRow['package_cost'];
			$this->package_duration = $dataRow['package_duration'];
			$this->duration_type = $dataRow['duration_type'];
			$this->package_description = $dataRow['package_description'];
			
		}
		
		// UPDATE
		public function updatePackage() {
			$sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        package_title = :package_title,
                        package_cost = :package_cost,
                        package_duration = :package_duration,
                        duration_type = :duration_type,
                        package_description = :package_description
                    WHERE
                        package_id = :package_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// sanitize
			$this->package_title = htmlspecialchars(strip_tags($this->package_title));
			$this->package_cost = htmlspecialchars(strip_tags($this->package_cost));
			$this->package_duration = htmlspecialchars(strip_tags($this->package_duration));
			$this->duration_type = htmlspecialchars(strip_tags($this->duration_type));
			$this->package_description = htmlspecialchars(strip_tags($this->package_description));
			$this->package_id = htmlspecialchars(strip_tags($this->package_id));
			
			
			// bind data
			$stmt->bindParam(":package_title", $this->package_title);
			$stmt->bindParam(":package_cost", $this->package_cost);
			$stmt->bindParam(":package_duration", $this->package_duration);
			$stmt->bindParam(":duration_type", $this->duration_type);
			$stmt->bindParam(":package_description", $this->package_description);
			$stmt->bindParam(":package_id", $this->package_id);
			
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
                        package_status = :package_status
                    WHERE 
                        package_id = :package_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// bind data
			$stmt->bindParam(":package_status", $this->package_status);
			$stmt->bindParam(":package_id", $this->package_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// DELETE
		function deletePackage() {
			$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE package_id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			
			$this->package_id = htmlspecialchars(strip_tags($this->package_id));
			
			$stmt->bindParam(1, $this->package_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
	}
