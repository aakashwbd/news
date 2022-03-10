<?php
    class Comment{

        // Connection
        private $conn;

        // Table
        private $db_table = "news_comment";
        private $db_table2 = "video_comment";
        private $news_tbl = "news";
        private $video_tbl = "videos";
        private $users_tbl = "users";

       
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // Get News Comment
        public function getCommentByNewsId($news_id){
        //     $sqlQuery = "SELECT *, ".$this->db_table.".id as comment_id,
        //                             ".$this->users_tbl.".id as user_id,
        //                             ".$this->news_tbl.".id as news_id,
        //                             ".$this->users_tbl.".image as user_image
								// FROM
								//      ".$this->db_table."
								// INNER JOIN
								// 	".$this->news_tbl."
								// ON
								// 	".$this->db_table.".news_id = ".$this->news_tbl.".id
								// INNER JOIN
								// 	".$this->users_tbl."
								// ON
								// 	".$this->db_table.".user_id = ".$this->users_tbl.".id
								// WHERE
								// 	".$this->db_table.".news_id = $news_id";
									
			$sqlQuery = "SELECT * FROM
								     ".$this->db_table."
								WHERE
									".$this->db_table.".news_id = $news_id";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        } 
        
        // Get News Comment
        public function getCommentByNewsAll(){
            $sqlQuery = "SELECT *, ".$this->db_table.".id as comment_id,
                                    ".$this->users_tbl.".id as user_id,
                                    ".$this->news_tbl.".id as news_id,
                                    ".$this->users_tbl.".image as user_image,
                                    ".$this->db_table.".status as comment_status
								FROM
								     ".$this->db_table."
								INNER JOIN
									".$this->news_tbl."
								ON
									".$this->db_table.".news_id = ".$this->news_tbl.".id
								INNER JOIN
									".$this->users_tbl."
								ON
									".$this->db_table.".user_id = ".$this->users_tbl.".id ";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
		
		
		// Get Video Comment
        public function getCommentByVideoId($video_id){
        //     $sqlQuery = "SELECT *,".$this->db_table2.".id as comment_id,
        //                              ".$this->users_tbl.".id as user_id,
        //                             ".$this->video_tbl.".id as video_id,
        //                             ".$this->users_tbl.".image as user_image
								// FROM
								//      ".$this->db_table2."
								// INNER JOIN
								// 	".$this->video_tbl."
								// ON
								// 	".$this->db_table2.".video_id = ".$this->video_tbl.".id
								// INNER JOIN
								// 	".$this->users_tbl."
								// ON
								// 	".$this->db_table2.".user_id = ".$this->users_tbl.".id
								// WHERE
								// 	".$this->db_table2.".video_id = $video_id";
									
			$sqlQuery = "SELECT * FROM
							     ".$this->db_table2."
							WHERE
								".$this->db_table2.".video_id = $video_id";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }		
		// Get Video Comment
        public function getCommentByVideoAll(){
            $sqlQuery = "SELECT *,".$this->db_table2.".id as comment_id,
                                     ".$this->users_tbl.".id as user_id,
                                    ".$this->video_tbl.".id as video_id,
                                    ".$this->users_tbl.".image as user_image,
                                    ".$this->db_table2.".status as comment_status
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
        public function saveNewsComment($data, $user_id){
			
            $sqlQuery = "INSERT INTO ".$this->db_table."
                        SET
                            news_id = :news_id,
                            user_id = :user_id,
                            comment_text = :comment_text";
   
            $stmt = $this->conn->prepare($sqlQuery);
        
      
            // bind data
            $stmt->bindParam(":news_id", $data->news_id);
            $stmt->bindParam(":comment_text", $data->comment);
            $stmt->bindParam(":user_id", $user_id);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
		
		// Save Video Comment
        public function saveVideoComment($data, $user_id){
			
            $sqlQuery = "INSERT INTO ".$this->db_table2."
                        SET
                            video_id = :video_id,
                            user_id = :user_id,
                            comment_text = :comment_text";
   
            $stmt = $this->conn->prepare($sqlQuery);
        
      
            // bind data
            $stmt->bindParam(":video_id", $data->video_id);
            $stmt->bindParam(":comment_text", $data->comment);
            $stmt->bindParam(":user_id", $user_id);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
	
	    // UPDATE ACTIVE STATUS
	    public function updateStatusNews($id, $status){
		    $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        status = :status
                    WHERE
                        id = :id";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		
		    // bind data
		    $stmt->bindParam(":status", $status);
		    $stmt->bindParam(":id",  $id);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
		
		// UPDATE ACTIVE STATUS Video Comment
	    public function updateStatusVideo($id, $status){
		    $sqlQuery = "UPDATE
                        ". $this->db_table2 ."
                    SET
                        status = :status
                    WHERE
                        id = :id";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		
		    // bind data
		    $stmt->bindParam(":status", $status);
		    $stmt->bindParam(":id",  $id);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }

  
        // DELETE News comment
	    function deleteNewsComment($id) {
		    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id ";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(":id", $id);
		
		    if ($stmt->execute()) {
			    return true;
		    }
		    return false;
	    }
		
		// DELETE Video comment
	    function deleteVideoComment($id) {
		    $sqlQuery = "DELETE FROM " . $this->db_table2 . " WHERE id = :id ";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(":id", $id);
		
		    if ($stmt->execute()) {
			    return true;
		    }
		    return false;
	    }
    }