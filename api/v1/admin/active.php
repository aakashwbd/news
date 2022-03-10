<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/Language.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Language($db);

    
    // acitve status update
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $item->category_id = $_POST['id'];
        $item->active_status = $_POST['status'];

        // var_dump($item->category_id);
        // var_dump( $item->active_status);
        // die;


        if($item->updateStatus()){

            if($item->active_status === 'active'){
                echo json_encode([
                    'status' => 'active',
                    "message" => "Language Active"
                ]);
            } else if($item->active_status === 'inactive'){
                echo json_encode([
                    'status' => 'inactive',
                    "message" => "Language inActive"
                ]);
            }
        } else{
            echo json_encode([
                'status' => 'error',
                "message" => "Language update unsuccess."
            ]);
        }
 
    }
    
?>