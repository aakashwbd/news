<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/User.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	include_once __DIR__ . '/../../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;
	
	$user = new User($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (!empty($errors)) {
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	try {
		$response_data = [];
		if ($token !== "") {
			$decoded = JWT::decode($token, $key, ['HS256']);
			$user_id = $decoded->data->id;
			
			$existUser = $user->getSingleUser($user_id);
			$row = $existUser->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$response_data = [
				"id" => $id,
				"name" => $name,
				"email" => $email,
				"phone" => $phone,
				"image" => $image
			];
			
			
			// set response code
			http_response_code(200);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			echo json_encode($response);
			
		}
		else {
			$errors[] = (object)['field' => "global", 'error' => "you are not authorized"];
			$response->status = 'error';
			$response->status_code = 400;
			$response->messages = $errors;
			http_response_code(400);
			echo json_encode($response);
			die();
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
	