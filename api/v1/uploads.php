<?php
	include_once __DIR__."/bootstrap/header.php";
	
    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
		
	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	
	    $file_name = $_FILES['file']['name'];
	    $file_size = $_FILES['file']['size'];
	    $file_temp = $_FILES['file']['tmp_name'];
	
	
	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "/uploads/".$unique_image;
	
	    if ($file_size >10048567) {
		    echo json_encode([
                 "status" => "error",
                 "message" => "Image Size should be less then 10MB!"
		    ]);
	    } else if (in_array($file_ext, $permited) === false) {
		    echo json_encode([
                 "status" => "error",
                 "message" => "You can upload only:-"
                     .implode(', ', $permited)." "
		    ]);
	    }else{
		    move_uploaded_file($file_temp, "../../".$uploaded_image);
		
		    echo json_encode([
	             "status" => "success",
				 "data" => $_SERVER['REQUEST_SCHEME']. '://'. $_SERVER['HTTP_HOST'] . $uploaded_image
		    ]);
	    }
	
    }
