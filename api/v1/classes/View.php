<?php
    class View{

        // Connection
        private $conn;

        // Table
        private $db_table = "news_view";
        private $db_table2 = "video_view";

      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	
	    // save
	    public function newsViwesave($news_id){
		    $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        news_id = :news_id ";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":news_id", $news_id);
		
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }    
        
        // save
	    public function videoViwesave($video_id){
		    $sqlQuery = "INSERT INTO
                        ". $this->db_table2 ."
                    SET
                        video_id = :video_id ";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":video_id", $video_id);
		
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
		
	
        public function newsViewCount($news_id)
        {
            $sqlQuery = "SELECT count(*) as total FROM
                            " . $this->db_table . "
                        WHERE
                            news_id = :news_id ";
    
            $stmt = $this->conn->prepare($sqlQuery);
    
            // bind data
            $stmt->bindParam(":news_id", $news_id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_COLUMN);
        }
        
        public function videoViewCount($video_id)
        {
            $sqlQuery = "SELECT count(*) as total FROM
                            " . $this->db_table2 . "
                        WHERE
                            video_id = :video_id ";
    
            $stmt = $this->conn->prepare($sqlQuery);
    
            // bind data
            $stmt->bindParam(":video_id", $video_id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_COLUMN);
        }
    }