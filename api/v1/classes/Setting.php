<?php
    class Setting{

        // Connection
        private $conn;

        // Table
        private $db_table = "settings";


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function get(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function save($data){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        system_name = :system_name, 
                        app_version = :app_version,
                        email = :email,
                        update_app = :update_app,
                        developed_by = :developed_by,
                        facebook_link = :facebook_link,
                        instagram_link = :instagram_link,
                        twitter_link = :twitter_link,
                        youtube_link = :youtube_link,
                        logo = :logo,
                        description = :description,
                        copyrights = :copyrights,
                        privacy_policy = :privacy_policy,
                        cookies_policy = :cookies_policy,
                        terms_policy = :terms_policy";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
    
	        // sanitize
	        $name = htmlspecialchars(strip_tags($data->name));
	        $version = htmlspecialchars(strip_tags($data->app_version));
	        $mail = htmlspecialchars(strip_tags($data->mail));
	        $update = htmlspecialchars(strip_tags($data->update_app));
	        $developed = htmlspecialchars(strip_tags($data->developed_by));
	        $facebook = htmlspecialchars(strip_tags($data->facebook_link));
	        $instagram = htmlspecialchars(strip_tags($data->instagram_link));
	        $twitter = htmlspecialchars(strip_tags($data->twitter_link));
	        $youtube = htmlspecialchars(strip_tags($data->youtube_link));
	        $logo = htmlspecialchars(strip_tags($data->logo));
	        $copyrights = htmlspecialchars(strip_tags($data->copyright));
         
         
            // bind data
            $stmt->bindParam(":system_name", $name);
            $stmt->bindParam(":app_version", $version);
            $stmt->bindParam(":email", $mail);
			
            $stmt->bindParam(":update_app", $update);
            $stmt->bindParam(":developed_by", $developed);
			
            $stmt->bindParam(":facebook_link", $facebook);
            $stmt->bindParam(":instagram_link", $instagram);
            $stmt->bindParam(":twitter_link", $twitter);
            $stmt->bindParam(":youtube_link", $youtube);
			
            $stmt->bindParam(":logo", $logo);
	        $stmt->bindParam(":copyrights", $copyrights);
			
            $stmt->bindParam(":description", $data->description);
            $stmt->bindParam(":privacy_policy", $data->privacy_policy);
            $stmt->bindParam(":cookies_policy",$data->cookies_policy);
            $stmt->bindParam(":terms_policy", $data->terms_policy);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
		
		// update
        public function update($data){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        system_name = :system_name,
                        app_version = :app_version,
                        email = :email,
                        update_app = :update_app,
                        developed_by = :developed_by,
                        facebook_link = :facebook_link,
                        instagram_link = :instagram_link,
                        twitter_link = :twitter_link,
                        youtube_link = :youtube_link,
                        logo = :logo,
                        description = :description,
                        copyrights = :copyrights,
                        privacy_policy = :privacy_policy,
                        cookies_policy = :cookies_policy,
                        terms_policy = :terms_policy";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
	        $name = htmlspecialchars(strip_tags($data->name));
	        $version = htmlspecialchars(strip_tags($data->app_version));
	        $mail = htmlspecialchars(strip_tags($data->mail));
	        $update = htmlspecialchars(strip_tags($data->update_app));
	        $developed = htmlspecialchars(strip_tags($data->developed_by));
	        $facebook = htmlspecialchars(strip_tags($data->facebook_link));
	        $instagram = htmlspecialchars(strip_tags($data->instagram_link));
	        $twitter = htmlspecialchars(strip_tags($data->twitter_link));
	        $youtube = htmlspecialchars(strip_tags($data->youtube_link));
	        $logo = htmlspecialchars(strip_tags($data->logo));
	        $copyrights = htmlspecialchars(strip_tags($data->copyright));
         
         
            // bind data
            $stmt->bindParam(":system_name", $name);
            $stmt->bindParam(":app_version", $version);
            $stmt->bindParam(":email", $mail);
			
            $stmt->bindParam(":update_app", $update);
            $stmt->bindParam(":developed_by", $developed);
			
            $stmt->bindParam(":facebook_link", $facebook);
            $stmt->bindParam(":instagram_link", $instagram);
            $stmt->bindParam(":twitter_link", $twitter);
            $stmt->bindParam(":youtube_link", $youtube);
			
            $stmt->bindParam(":logo", $logo);
	        $stmt->bindParam(":copyrights", $copyrights);
			
            $stmt->bindParam(":description", $data->description);
            $stmt->bindParam(":privacy_policy", $data->privacy_policy);
            $stmt->bindParam(":cookies_policy",$data->cookies_policy);
            $stmt->bindParam(":terms_policy", $data->terms_policy);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
	
	    public function getSingleData() {
		    $sqlQuery = "SELECT *
                      FROM
                        " . $this->db_table . " ";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->execute();
			
			return $stmt;
	    }
	
	   
    }
