<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Favourite.php';
	
	include_once __DIR__ . '/../../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;


	$database = new Database();
	$db = $database->getConnection();
	
	$favourite= new Favourite($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];
	
	if (!empty($errors)) {
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	try {
		if ($token !== "") {
			$decoded = JWT::decode($token, $key, ['HS256']);
			$user_id = $decoded->data->id;	

			$save = $favourite->newsSave($data, $user_id);
		
			$response->status = 'success';
			$response->status_code = 200;
			$response->message = 'Add to favourite list.';
			echo json_encode($response);
		}
		
		
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	