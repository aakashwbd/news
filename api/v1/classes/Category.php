<?php
    class Category{

        // Connection
        private $conn;

        // Table
        private $db_table = "categories";

      
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	
	    // save
	    public function save($data){
		    $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name,
                        image = :image";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		
		    // sanitize
		    $name = htmlspecialchars(strip_tags($data->name));
		   
		
		    // bind data
		    $stmt->bindParam(":name", $name);
		    $stmt->bindParam(":image", $data->logo);
		
		
		    if($stmt->execute()){
			    return true;
		    }
		    return false;
	    }
	
	    // GET ALL Active
	    public function getAll(){
		    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE status = 'Active' ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    } 
		
		// GET ALL
	    public function getAllCategory(){
		    $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    }
		
		//	search
		public function search($data){
		    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE name LIKE '%$data->autoComplete%' ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    }
		
		//	search by dashboard
		public function searchCategory($data){
		    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE name LIKE '%$data->search%' ";
		    $stmt = $this->conn->prepare($sqlQuery);
		    $stmt->execute();
		    return $stmt;
	    }
		

	    //  CHECK Exist data
	    public function check($name){
		
		    $selectQuery = "SELECT *
								FROM
								     ".$this->db_table."
                                WHERE
                                    name = :name ";
		    $stmt = $this->conn->prepare($selectQuery);
		    // bind data
		    $stmt->bindParam(':name', $name);
		    $stmt->execute();
		    $num = $stmt->rowCount();
		    if($num > 0){
			    $row = $stmt->fetch(PDO::FETCH_ASSOC);
			    $id = $row['id'];
			    $name = $row['name'];
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

        // UPDATE CATEGORY
	    public function update($name, $image, $id) {
		    $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        name = :name,
                        image= :image
                    WHERE
                        id = :id ";
		
		    $stmt = $this->conn->prepare($sqlQuery);
		    // sanitize
		    $name = htmlspecialchars(strip_tags($name));
		
		
		    // bind data
		    $stmt->bindParam(":name", $name);
		    $stmt->bindParam(":image", $image);
		    $stmt->bindParam(":id", $id);
		
		    if ($stmt->execute()) {
			    return true;
		    }
		    return false;
	    }

	    // UPDATE ACTIVE STATUS
	    public function updateStatus($id, $status){
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