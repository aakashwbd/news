<?php
	
	class Language {
		
		// Connection
		private $conn;
		
		
		// Table
		private $db_table = "language";
		
		// Columns
		public $language_id;
		public $language_name;
		public $language_status;
		public $updated_at;
		
		
		
		
		// Db connection
		
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// GET ALL
		        public function getLanguage(){
		            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
		            $stmt = $this->conn->prepare($sqlQuery);
		            $stmt->execute();
		            return $stmt;
		        }
		
		// CREATE
		public function createLanguage() {
			$sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        language_name = :language_name";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// sanitize
			$this->language_name = htmlspecialchars(strip_tags($this->language_name));
			
			// bind data
			$stmt->bindParam(":language_name", $this->language_name);
			
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		//  CHECK Exist data
		public function checkLanguage() {
			$selectQuery = "SELECT * FROM " . $this->db_table . "
                             WHERE
                                 language_name = ? LIMIT 0, 1";
			$stmt = $this->conn->prepare($selectQuery);
			
			// sanitize
			$this->language_name = htmlspecialchars(strip_tags($this->language_name));
			
			
			// bind data
			$stmt->bindParam(1, $this->language_name);
			
			$stmt->execute();
			
			// get number of rows
			$num = $stmt->rowCount();
			
			// if name exists, assign values to object properties for easy access and use for php sessions
			if ($num > 0) {
				
				// get record details / values
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				// assign values to object properties
				$this->language_id = $row['language_id'];
				$this->language_name = $row['language_name'];
				$this->language_status = $row['language_status'];
				
				// return true because name exists in the database
				return true;
			}
			
			// return false if name does not exist in the database
			return false;
		}
		
		// READ single
		public function getSingleLanguage() {
			$sqlQuery = "SELECT *
					FROM
                        " . $this->db_table . "
                    WHERE 
                       language_id = ?";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(1, $this->language_id);
			
			$stmt->execute();
			
			$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->language_name = $dataRow['language_name'];
			
		}
		
		// UPDATE
		public function updateLanguage() {
			$sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        language_name = :language_name
                    WHERE 
                        language_id = :language_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// sanitize
			$this->language_name = htmlspecialchars(strip_tags($this->language_name));
			$this->language_id = htmlspecialchars(strip_tags($this->language_id));
			
			
			// bind data
			$stmt->bindParam(":language_name", $this->language_name);
			$stmt->bindParam(":language_id", $this->language_id);
			
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
                        language_status = :language_status
                    WHERE 
                        language_id = :language_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
		
			
			// bind data
			$stmt->bindParam(":language_status", $this->language_status);
			$stmt->bindParam(":language_id", $this->language_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// DELETE
		function deleteLanguage() {
			$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE language_id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			
			$this->language_id = htmlspecialchars(strip_tags($this->language_id));
			
			$stmt->bindParam(1, $this->language_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
	}
