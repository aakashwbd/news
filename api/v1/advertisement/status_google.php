<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../class/Advertisement.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Advertisement($db);

    
    // acitve goolge status update
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['google_status'] ){

        $item->advertisement_id = $_POST['id'];
        $item->gg_ad_status = $_POST['google_status'];

        $item->fb_ad_status = 'inactive';
        $item->custom_ad_status = 'inactive';
        $item->startup_ad_status = 'inactive';

        if($item->updateGoogleAd()){

            if($item->gg_ad_status === 'active'){
                echo json_encode([
                    'status' => 'active',
                    "message" => "Google Ad Active"
                ]);
            } else if($item->gg_ad_status === 'inactive'){
                echo json_encode([
                    'status' => 'inactive',
                    "message" => "Google Ad inActive"
                ]);
            }
        } else{
            echo json_encode([
                'status' => 'error',
                "message" => "Google Ad update unsuccess."
            ]);
        }
    }

      
    
?>