<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/User.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new User($db);

    $item->user_id = isset($_GET['edit_user']) ? $_GET['edit_user'] : die();
  
    $item->getSingleUser();

    if($item->user_name !== null){
        // create array
        $user = array(
            "user_id" => $item->user_id,
            "user_name" =>$item->user_name,
            "user_email" => $item->user_email,
            "user_phone" => $item->user_phone,
            "user_image" => $item->user_image,
        );
      
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $user
        ]);
    }
      
    else{
        http_response_code(404);
        echo json_encode("user not found.");
    }
?>