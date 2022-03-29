<?php
    class Notification{

        // Connection
        private $conn;

        // Table
        private $db_table = "notifications";
        private $db_table2 = "manage_notification";
        private $db_table3 = "news";
     

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	
	    // Save Notification
	    public function saveNotification($data) {
		    $sqlQuery = "INSERT INTO ". $this->db_table ."
                    SET
                        title = :title,
                        description = :description,
                        link = :link,
                        image = :image,
                        item_id=:item_id";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":title", $data->title);
		    $stmt->bindParam(":description", $data->description);
		    $stmt->bindParam(":link", $data->link);
		    $stmt->bindParam(":image", $data->logo);
		    $stmt->bindParam(":item_id", $data->news_id);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }

        // GET ALL
        public function getAll(){
            $sqlQuery = "SELECT * FROM ".$this->db_table." " ;

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
		
		
		// Check Manage Notification Data Exist or Not
        public function checkSetting(){
            $sqlQuery = "SELECT * FROM ".$this->db_table2." " ;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
		
		//create manage notification in database
	    public function saveSetting($data){
		    $sqlQuery = "INSERT
							INTO
							    ". $this->db_table2 ."
                            SET
                                app_id = :app_id,
                                api_key = :api_key";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // bind data
		    $stmt->bindParam(":app_id", $data->app_id);
		    $stmt->bindParam(":api_key", $data->api_key);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
		
		//update manage notification
	    public function updateSetting($data){
		    $sqlQuery = "Update ". $this->db_table2 ."
                    SET
                        app_id = :app_id,
                        api_key = :api_key";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		
		    // bind data
		    $stmt->bindParam(":app_id", $data->app_id);
		    $stmt->bindParam(":api_key", $data->api_key);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
		
		//	GET API KEY & APP ID
		public function getNotificationSetting(){
            $sqlQuery = "SELECT *
							FROM
							     ".$this->db_table2." " ;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
			return $stmt;
        }
        

        
		
	
		
	

               

       

        // UPDATE ACTIVE STATUS
        public function updateStatus(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        status = :status
                    WHERE
                        notification_id = :notification_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            
        
            // bind data
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":notification_id",  $this->notification_id);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }
	
	
	    // DELETE
	    function delete($id){
		    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id";
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    $stmt->bindParam(":id", $id);
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
        
        public function sendMessage($title, $description, $external_link, $imageUrl, $api_id, $api_key)
        {
            $content = array(
                "en" => $description, // description
            );
    
            $hashes_array = array();

            $hashes_array[] = [
	            "id" => "like-button",
	            "text" => $title, // title
	            "icon" => $imageUrl,
	            "url" => $external_link,
            ];
	
	        // array_push($hashes_array, array(
            //     "id"   => "like-button-2",
            //     "text" => "Like2",
            //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
            //     "url"  => "https://yoursite.com",
            // ));
            
            $fields = array(
                'app_id'            => $api_id,
                'included_segments' => array(
                    'Subscribed Users',
                ),
                'data'              => array(
                    "foo" => "bar",
                ),
                'contents'          => $content,
                'web_buttons'       => $hashes_array,
            );
            $fields = json_encode($fields);
            // print("\nJSON sent:\n");
            // print($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                "Authorization: Basic $api_key",
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }
    }
