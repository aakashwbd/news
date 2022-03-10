<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/News.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new News($db);

    
    // acitve status update
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $item->news_id = $_POST['id'];
        $item->status = $_POST['status'];

        // var_dump($item->notificaiton_id);
        // var_dump( $item->status);
        // die;


        if($item->updateStatus()){

            if($item->status === 'active'){
                echo json_encode([
                    'status' => 'active',
                    "message" => "News Active"
                ]);
            } else if($item->status === 'inactive'){
                echo json_encode([
                    'status' => 'inactive',
                    "message" => "News inActive"
                ]);
            }
        } else{
            echo json_encode([
                'status' => 'error',
                "message" => "News update unsuccess."
            ]);
        }
 
    }
    
?>