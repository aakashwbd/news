<?php
    class Advertisement{

        // Connection
        private $conn;

        // Table
        private $db_table = "advertisement";

        // Columns
        public $id;
      
        public $ad_type;
		
        public $status;
		
        public $banner_id;
        public $banner_link;
        public $banner_image;
		
        public $interstitial_id;
        public $interstitial_link;
        public $interstitial_image;
        public $interstitial_click;
		
        public $native_id;
        public $native_link;
        public $native_image;
        public $native_per_radio;
		
        public $startup_id;
		
		
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAdvertisement(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
	    public  function  create($data) {
		
		    $sql = "INSERT INTO
    					". $this->db_table ."
    					 SET
    					    ad_type = :ad_type,
    					    status = :status,
    					    banner_id = :banner_id,
    					    banner_link = :banner_link,
    					    banner_image = :banner_image,
    					    interstitial_id = :interstitial_id,
    					    interstitial_link = :interstitial_link,
    					    interstitial_click = :interstitial_click,
    					    interstitial_image = :interstitial_image,
    					    native_id = :native_id,
    					    native_link = :native_link,
    					    native_per_news = :native_per_news,
    					    native_per_video = :native_per_video,
    					    native_image = :native_image,
    					    startup_id = :startup_id";
		    $stmt = $this->conn->prepare($sql);
			
            // bind data
            $stmt->bindParam(":ad_type", $data['ad_type'] );
            $stmt->bindParam(":status", $data['status']);
            $stmt->bindParam(":banner_id", $data['banner_id'] );
            $stmt->bindParam(":banner_link", $data['banner_link'] );
            $stmt->bindParam(":banner_image", $data['banner_image'] );
            $stmt->bindParam(":interstitial_id", $data['interstitial_id'] );
            $stmt->bindParam(":interstitial_link", $data['interstitial_link'] );
            $stmt->bindParam(":interstitial_click", $data['interstitial_click'] );
            $stmt->bindParam(":interstitial_image", $data['interstitial_image'] );
            $stmt->bindParam(":native_id", $data['native_id'] );
            $stmt->bindParam(":native_link", $data['native_link'] );
            $stmt->bindParam(":native_per_news", $data['native_per_news'] );
            $stmt->bindParam(":native_per_video", $data['native_per_video'] );
            $stmt->bindParam(":native_image", $data['native_image'] );
            $stmt->bindParam(":startup_id", $data['startup_id'] );
        
            if($stmt->execute()){
                return true;
            }
            return false;
	    }
        
		

	// update
	    public  function  update($data) {
			
		
		    $sql = "UPDATE ". $this->db_table ."
    					 SET
    					    status = :status,
    					    banner_id = :banner_id,
    					    banner_link = :banner_link,
    					    banner_image = :banner_image,
    					    interstitial_id = :interstitial_id,
    					    interstitial_link = :interstitial_link,
    					    interstitial_click = :interstitial_click,
    					    interstitial_image = :interstitial_image,
    					    native_id = :native_id,
    					    native_link = :native_link,
    					    native_per_news = :native_per_news,
    					    native_per_video = :native_per_video,
    					    native_image = :native_image,
    					    startup_id = :startup_id
    					 WHERE
    					    ad_type = :ad_type ";
			
		    $stmt = $this->conn->prepare($sql);
			
            // bind data
            $stmt->bindParam(":ad_type", $data['ad_type'] );
            $stmt->bindParam(":status", $data['status']);
            $stmt->bindParam(":banner_id", $data['banner_id'] );
            $stmt->bindParam(":banner_link", $data['banner_link'] );
            $stmt->bindParam(":banner_image", $data['banner_image'] );
            $stmt->bindParam(":interstitial_id", $data['interstitial_id'] );
            $stmt->bindParam(":interstitial_link", $data['interstitial_link'] );
            $stmt->bindParam(":interstitial_click", $data['interstitial_click'] );
            $stmt->bindParam(":interstitial_image", $data['interstitial_image'] );
            $stmt->bindParam(":native_id", $data['native_id'] );
            $stmt->bindParam(":native_link", $data['native_link'] );
            $stmt->bindParam(":native_per_news", $data['native_per_news'] );
            $stmt->bindParam(":native_per_video", $data['native_per_video'] );
            $stmt->bindParam(":native_image", $data['native_image'] );
            $stmt->bindParam(":startup_id", $data['startup_id'] );
        
            if($stmt->execute()){
                return true;
            }
            return false;
	    }
     
		
    }
