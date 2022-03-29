<?php
	
	class Video {
		
		// Connection
		private $conn;
		
		// Table
		private $db_table = "videos";
		private $video_view = "video_view";
		
		
		// Db connection
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// GET ALL
		public function getAll() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// GET ALL By Featues
		public function getAllFeature() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE status = 'Active' AND cateogry_type = 'feature' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// GET ALL By Date
		public function getByDate($data) {
			if ($data) {
				$date = date_create($data);
				$dateFormate = date_format($date, "Y/m/d");
				
				$sqlQuery = "SELECT *  FROM " . $this->db_table . " WHERE status = 'Active' AND  created_at = :created_at";
				
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $dateFormate);
			}
			else {
				$currentDate = date('Y-m-d');
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE status = 'Active' AND created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $currentDate);
			}
			
			$stmt->execute();
			return $stmt;
		}
		
		
		// GET ALL
		public function getByFeatureDate($data) {
			
			$date = date_create($data);
			$dateFormate = date_format($date, "Y/m/d");
			$finalDate = str_replace("/", "-", $dateFormate);
			
			
			$currentDate = date('Y-m-d');
			
			if ($data) {
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE category_type = 'feature' AND  created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $finalDate);
			}
			else {
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE category_type = 'feature' AND created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $currentDate);
			}
			
			$stmt->execute();
			return $stmt;
		}
		
		// CREATE
		public function save($data) {
			$sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
						video_type= :video_type,
                        title = :title,
                        url = :url,
                        description = :description,
                        image = :image ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			// bind data
			$stmt->bindParam(":video_type", $data->video_type);
			$stmt->bindParam(":title", $data->title);
			$stmt->bindParam(":url", $data->url);
			$stmt->bindParam(":description", $data->description);
			$stmt->bindParam(":image", $data->logo);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// READ single
		public function getEditData($id) {
			$sqlQuery = "SELECT *
					FROM
                        " . $this->db_table . "
                    WHERE
                       id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			$stmt->execute();
			return $stmt;
			
			
		}
		
		//single video show in app
		public function singleVideoShow($id) {
			$sqlQuery = "SELECT *,
							(SELECT COUNT(video_id) FROM " . $this->video_view . " WHERE video_id = " . $this->db_table . ".id) as video_count FROM " . $this->db_table . " WHERE id = :id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			$stmt->execute();
			return $stmt;
			
			
		}
		
		// UPDATE News without image
		public function update($video_type, $title, $url, $description, $image, $id) {
			$sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
					video_type= :video_type,
                        title = :title,
                        url = :url,
                        description = :description,
                        image = :image
                    WHERE
                        id = :id ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":title", $title);
			$stmt->bindParam(":url", $url);
			$stmt->bindParam(":description", $description);
			$stmt->bindParam(":image", $image);
			$stmt->bindParam(":video_type", $video_type);
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// UPDATE ACTIVE STATUS
		public function updateStatus($id, $status) {
			$sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        status = :status
                    WHERE
                        id = :id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":status", $status);
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
		// DELETE
		function delete($id) {
			$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id ";
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// search
		public function searchVideo($data) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE title LIKE '%$data->search_data%' OR description LIKE '%$data->search_data%' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		
	}