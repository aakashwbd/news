<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Favourite.php';

    include_once __DIR__ . '/../../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;
	
	$database = new Database();
	$db = $database->getConnection();
	
	$favourite = new Favourite($db);
	
	// $data = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];

	try {
        $response_data = [];
        if ($token !== "") {
			$decoded = JWT::decode($token, $key, ['HS256']);
			$user_id = $decoded->data->id;	

            $get = $favourite->getNewsFavourite($user_id);

            while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                $response_data[] = $row;
            }
            http_response_code(200);
		
            $response->status = 'success';
            $response->status_code = 200;
            $response->data = $response_data;
            echo json_encode($response);
		}
		
		
		
		
		// while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
		// 	// extract($row);
			
		// 	// $e = [
		// 	// 	"id" => $favourite_id,
		// 	// 	'radio_id' => $radio_id,
		// 	// 	'user_id' => $user_id,
		// 	// 	'country_id' => $country_id,
		// 	// 	'language_id' => $language_id,
		// 	// 	'category' => $category,
		// 	// 	'radio_name' => $radio_name,
		// 	// 	'frequency' => $frequency,
		// 	// 	'url' => $url,
		// 	// 	'description' => $description,
		// 	// ];
			
		// 	$response_data[] = $row;
		// }
		
		// // set response code
		// http_response_code(200);
		
		// $response->status = 'success';
		// $response->status_code = 200;
		// $response->data = $response_data;
		// echo json_encode($response);
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	