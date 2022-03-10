<?php
	
	class News {
		
		// Connection
		private $conn;
		
		// Table
		private $db_table = "news";
		private $cat_tbl = "categories";
		private $news_view = "news_view";
		
		
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
		
		// GET ALL
		public function getByActive() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE status = 'Active' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		// GET ALL
		public function getByInactive() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE status = 'Inactive' ";
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
			if($data){
				$date=date_create($data);
				$dateFormate = date_format($date,"Y-m-d");
				
				$sqlQuery = "SELECT *  FROM " . $this->db_table . " WHERE status = 'Active' AND  created_at = :created_at";
			    
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $dateFormate);
			} else{
				$currentDate = date('Y-m-d');
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE  'Active' AND created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $currentDate);
			}

			$stmt->execute();
			return $stmt;
		}


		// GET ALL
		public function getByFeatureDate($data) {
			if($data){
			    $date=date_create($data);
                $dateFormate = date_format($date,"Y/m/d");
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE category_type = 'feature' AND  created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $dateFormate);
			} else{
			    $currentDate = date('Y-m-d');
				$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE category_type = 'feature' AND created_at = :created_at";
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bindParam(":created_at", $currentDate);
			}

			$stmt->execute();
			return $stmt;
		}
		
		// GET ALL
		public function getAllByImage() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE type = 'image' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// GET ALL by video
		public function getAllByVideo() {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE type = 'video' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		//		search
		public function searchNews($data) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE title LIKE '%$data->search%' OR description LIKE '%$data->search%' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		//		search
		public function search($data) {
			$sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE title LIKE '%$data->autoComplete%' ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// GET ALL
		public function getAllByCategory($id) {
			$idString = (string)$id;
			$sqlQuery = <<<TEXT
							SELECT * FROM $this->db_table WHERE JSON_CONTAINS(category_id, '["$idString"]')
						TEXT;
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		// CREATE
		public function save($data, $status) {
			
			$sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        type = :type,
                        category_type = :category_type,
                        category_id = :category_id,
                        title = :title,
                        description = :description,
                        link = :link,
                        image = :image,
						status = :status ";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			$category_id = json_encode($data->category);
			
			
			// bind data
			$stmt->bindParam(":type", $data->type);
			$stmt->bindParam(":category_type", $data->category_type);
			$stmt->bindParam(":category_id", $category_id);
			$stmt->bindParam(":title", $data->title);
			$stmt->bindParam(":description", $data->description);
			$stmt->bindParam(":image", $data->logo);
			$stmt->bindParam(":link", $data->link);
			$stmt->bindParam(":status", $status);
			
			
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
		
		// single news show in app with view count
		
		public function singleNewsShow($id) {
			$sqlQuery = "SELECT *, 
							(SELECT COUNT(news_id) FROM " . $this->news_view . " WHERE news_id = " . $this->db_table . ".id) as news_count FROM " . $this->db_table . " WHERE id = :id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			$stmt->execute();
			return $stmt;
			
			
		}
		
		
		// UPDATE News without image
		public function update($data, $id) {

			$sqlQuery = "UPDATE " . $this->db_table . "
                    SET
                        type = :type,
                        category_type = :category_type,
                        category_id = :category_id,
                        title = :title,
                        description = :description,
                        link = :link,
                        image = :image
                    WHERE 
                       id = :id";
			
			$stmt = $this->conn->prepare($sqlQuery);
		
			
			// bind data
			$stmt->bindParam(":type", $data->type);
			$stmt->bindParam(":category_type", $data->category_type);
			$stmt->bindParam(":category_id", $data->category);
			$stmt->bindParam(":title", $data->title);
			$stmt->bindParam(":description", $data->description);
			$stmt->bindParam(":image", $data->logo);
			$stmt->bindParam(":link", $data->link);
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
		
		
	}