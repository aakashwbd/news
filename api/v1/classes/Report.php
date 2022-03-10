<?php
	class Report{
		
		// Connection
		private $conn;
		
		// Table
		private $db_table = "news_report";
		private $db_table2 = "video_report";
		private $news_tbl = "news";
		private $video_tbl = "videos";
		private $users_tbl = "users";
		
		
		// Db connection
		public function __construct($db){
			$this->conn = $db;
		}
		
		// Get News Comment
		public function getAllNewsReport(){
			$sqlQuery = "SELECT *, ".$this->db_table.".id as report_id, ".$this->db_table.".status as report_status
								FROM
								     ".$this->db_table."
								INNER JOIN
									".$this->news_tbl."
								ON
									".$this->db_table.".news_id = ".$this->news_tbl.".id
								INNER JOIN
									".$this->users_tbl."
								ON
									".$this->db_table.".user_id = ".$this->users_tbl.".id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		
		// Get Video Comment
		public function getAllVideoReport(){
			$sqlQuery = "SELECT *, ".$this->db_table2.".id as report_id, ".$this->db_table2.".status as report_status
								FROM
								     ".$this->db_table2."
								INNER JOIN
									".$this->video_tbl."
								ON
									".$this->db_table2.".video_id = ".$this->video_tbl.".id
								INNER JOIN
									".$this->users_tbl."
								ON
									".$this->db_table2.".user_id = ".$this->users_tbl.".id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		
		// Save News Comment
		public function saveNewsReport($data, $user_id){
			$sqlQuery = "INSERT INTO ".$this->db_table."
                        SET
                            news_id = :news_id,
                            user_id = :user_id,
                            report_text = :report_text";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":news_id", $data->news_id);
			$stmt->bindParam(":report_text", $data->report);
			$stmt->bindParam(":user_id", $user_id);
			
			
			if($stmt->execute()){
				return true;
			}
			return false;
		}
		
		// Save Video Comment
		public function saveVideoReport($data, $user_id){
			
			$sqlQuery = "INSERT INTO ".$this->db_table2."
                        SET
                            video_id = :video_id,
                            user_id = :user_id,
                            report_text = :report_text";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":video_id", $data->video_id);
			$stmt->bindParam(":report_text", $data->report);
			$stmt->bindParam(":user_id", $user_id);
			
			
			if($stmt->execute()){
				return true;
			}
			return false;
		}
		
		
		// DELETE News comment
		function deleteNewsReport($id) {
			$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id ";
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// DELETE Video comment
		function deleteVideoReport($id) {
			$sqlQuery = "DELETE FROM " . $this->db_table2 . " WHERE id = :id ";
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":id", $id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
	}