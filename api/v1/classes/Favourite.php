<?php
	
	class Favourite {
		
		// Connection
		public $favourite_id;
		
		// Table
		public $radio_id;
		public $user_id;
		private $conn;
		
		// Columns
		private $db_table = "news_favourite";
		private $db_table2 = "video_favourite";
		private $news_tbl = "news";
		private $video_tbl = "videos";
		private $users_tbl = "users";
		
		
		// Db connection
		
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// save
		public function isFavorite($news_id, $user_id) {
			$sqlQuery = "SELECT * FROM
                        " . $this->db_table . "
                    WHERE news_id = :news_id AND user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":news_id", $news_id);
			$stmt->bindParam(":user_id", $user_id);
			
			$stmt->execute();
// 			echo $stmt;
			return $stmt;
		}
		
		// save
		public function isVideoFavorite($video_id, $user_id) {
			$sqlQuery = "SELECT * FROM
                        " . $this->db_table2 . "
                    WHERE video_id = :video_id AND user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":video_id", $video_id);
			$stmt->bindParam(":user_id", $user_id);
			
			$stmt->execute();
// 			echo $stmt;
			return $stmt;
		}
		
		// save
		public function newsSave($data, $user_id) {
			$sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        news_id = :news_id,
                        user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":news_id", $data->news_id);
			$stmt->bindParam(":user_id", $user_id);
			
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		// save
		public function videoSave($data, $user_id) {
			$sqlQuery = "INSERT INTO
                        " . $this->db_table2 . "
                    SET
                        video_id = :video_id,
                        user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			
			// bind data
			$stmt->bindParam(":video_id", $data->video_id);
			$stmt->bindParam(":user_id", $user_id);
			
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		//	Check Radio
		public function checkRadio() {
			$sqlQuery = "SELECT * FROM  " . $this->db_table . "
                    WHERE
                       radio_id = ? LIMIT 0,1";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(1, $this->radio_id);
			
			$stmt->execute();
			
			$num = $stmt->rowCount();
			
			if ($num > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$this->favourite_id = $row['favourite_id'];
				$this->radio_id = $row['radio_id'];
				$this->user_id = $row['user_id'];
				
				return true;
			}
			return false;
			
		}
		
		// GET All  Favourite
		public function getNewsFavourite($user_id) {
			$sqlQuery = "SELECT *, " . $this->db_table . ".id as favourite_id,
									". $this->news_tbl . ".title as news_title
							FROM
							     " . $this->db_table . "
							INNER JOIN
								" . $this->news_tbl . "
							on
								" . $this->db_table . ".news_id = " . $this->news_tbl . ".id
							INNER JOIN
							" . $this->users_tbl . "
							ON
								" . $this->db_table . ".user_id = " . $this->users_tbl . ".id
							WHERE
								" . $this->db_table . ".user_id = :user_id ";
			
			$stmt = $this->conn->prepare($sqlQuery);

			$stmt->bindParam(":user_id", $user_id);
			$stmt->execute();
			return $stmt;
		}
		
		// GET All  Favourite
		public function getVideoFavourite($user_id) {
		
			$sqlQuery = "SELECT *
							FROM
							     " . $this->db_table2 . "
							INNER JOIN
								" . $this->video_tbl . "
							on
								" . $this->db_table2 . ".video_id = " . $this->video_tbl . ".id
							INNER JOIN
							" . $this->users_tbl . "
							ON
								" . $this->db_table2 . ".user_id = " . $this->users_tbl . ".id
							WHERE
								" . $this->db_table2 . ".user_id = :user_id ";
			
			$stmt = $this->conn->prepare($sqlQuery);

			$stmt->bindParam(":user_id", $user_id);
			$stmt->execute();
			return $stmt;
		}
		
		public function getByUser($id) {
			$sqlQuery = "SELECT *
							FROM
							     " . $this->db_table . "
							INNER JOIN
								" . $this->news_tbl . "
							on
								" . $this->db_table . ".radio_id = " . $this->news_tbl . ".radio_id
							INNER JOIN
								" . $this->users_tbl . "
							ON
								" . $this->db_table . ".user_id = " . $this->users_tbl . ".user_id
							WHERE
								" . $this->db_table . ".user_id = $id ";
			
			$stmt = $this->conn->prepare($sqlQuery);


			$stmt->execute();
			
			return $stmt;
		}
		
		
		// DELETE Radio favourite
		function deleteNewsFavourite($id, $user_id) {
			$sqlQuery = "DELETE
							FROM
							     " . $this->db_table . "
							WHERE
								news_id = :news_id AND user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":news_id", $id);
			$stmt->bindParam(":user_id", $user_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}		
		
		// DELETE Radio favourite
		function deleteVideoFavourite($id, $user_id) {
			$sqlQuery = "DELETE
							FROM
							     " . $this->db_table2 . "
							WHERE
								video_id = :video_id AND user_id = :user_id";
			
			$stmt = $this->conn->prepare($sqlQuery);
			
			$stmt->bindParam(":video_id", $id);
			$stmt->bindParam(":user_id", $user_id);
			
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		
		
	}
