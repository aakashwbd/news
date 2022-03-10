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
	
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	if (empty($data->current_password)) {
		$errors[] = (object)['field' => 'current_password', 'error' => 'Current Password is required.'];
	}
	
	if (empty($data->new_password)) {
		$errors[] = (object)['field' => 'new_password', 'error' => 'New Password is required.'];
	}
	
	if (!empty($data->new_password) && strlen($data->new_password) < 6) {
		$errors[] = (object)['field' => 'new_password', 'error' => 'New Password must be 6 characters.'];
	}
	
	if (empty($data->password_confirmation)) {
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Confirm Password is required.'];
	}
	
	if (!empty($data->password_confirmation) && strlen($data->password_confirmation) < 6) {
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Confirm Password must be 6 characters.'];
	}
	
	$id = null;
	$old_password = null;
	
	if ($token !== "") {
		$decoded = JWT::decode($token, $key, ['HS256']);
		$id = $decoded->data->id;
		$existUser = $user->getSingleUser($id);
		$row = $existUser->fetch(PDO::FETCH_ASSOC);
		$old_password = $row['password'];
	}
	else {
		$errors[] = (object)['field' => 'global', 'error' => 'You are not authorized.'];
	}
	
	
	if (!empty($errors)) {
		$response->status = 'validation_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
		$password_hash = md5($data->current_password);
		$new_password = md5($data->new_password);
		$password_confirmation = md5($data->password_confirmation);
		
		if ($old_password !== $password_hash) {
			$errors[] = (object)['field' => "current_password", 'error' => "Current password does not matched"];
			$response->status = 'validation_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		else if ($new_password !== $password_confirmation) {
			$errors[] = (object)['field' => "password_confirmation", 'error' => "confirm password does not matched"];
			$response->status = 'validation_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		else {
			$user = $user->updatePassword($new_password, $id);
			
			http_response_code(200);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->message = 'Password successfully Update.';
			
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
	