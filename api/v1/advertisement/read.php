<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
	
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Advertisement.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Advertisement($db);

    $stmt = $items->getAdvertisement();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);
    
    if($itemCount > 0){
        
        $ad = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $e = array(
                "id"                        => $id,
                "ad_type"                   => $ad_type,
                "status"                    => $status,
                "banner_id"                 => $banner_id,
                "banner_link"               => $banner_link,
                "banner_image"              => $banner_image,
                "interstitial_id"           => $interstitial_id,
                "interstitial_link"         => $interstitial_link,
                "interstitial_click"        => $interstitial_click,
                "interstitial_image"        => $interstitial_image,
                "native_id"                 => $native_id,
                "native_link"               => $native_link,
                "native_per_radio"          => $native_per_radio,
                "native_image"              => $native_image,
                "startup_id"                => $startup_id
            );

            $ad[] = $e;
        }
        echo json_encode([
            'status' => 'success',
            'data' => [
                'count' => $itemCount,
                'advertisement' => $ad
            ]
        ]);
    }

    else{
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            "message" => "No record found."
        ]);
    }