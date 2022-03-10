<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../util/custom_exception.php';
	
	use Firebase\JWT\JWT;
	
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Admin.php';
	
	// generate json web token
	include_once __DIR__ . "/../../bootstrap/jwt_config.php";
	
//	sleep(3);
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	if (empty($data->email)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is required.'];
	}
	if (!empty($data->email) && !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is invalid.'];
	}
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'Password is required.'];
	}
	if(!empty($data->password) && strlen($data->password) < 6){
		$errors[] = (object)['field' => 'password', 'error' => 'Password must be 6 characters.'];
	}
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
		$admin = $admin->getByEmail($data->email);
		
		if ($admin->role !== 'manage-admin' && $admin->role !== 'superAdmin') {
			$errors[] = (object)['field' => "global", 'error' => "You are not authorized."];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->messages = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		
		
		$password_hash = md5($data->password);
		
		if ($admin->password != $password_hash) {
			$errors[] = (object)['field' => "password", 'error' => "Password does not matched"];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		
		// Generating Data Object
		$response_data = [
			"id" => $admin->id,
			"email" => $admin->email,
			"name" => $admin->name,
			"role" => $admin->role,
			"access" => $admin->access,
			"image" => $admin->image,
		];
		
		// Generating Token
		$token = [
			"iat" => $issued_at,
			"exp" => $expiration_time,
			"iss" => $issuer,
			"data" => $response_data
		];
		// Generate JWT
		$jwt_token = JWT::encode($token, $key);
		
		$response_data['token'] = $jwt_token;
		
		// set response code
		http_response_code(200);
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = $response_data;
		http_response_code(200);
		echo json_encode($response);
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'validate_error';
		$response->status_code = 400;
		$response->data = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
