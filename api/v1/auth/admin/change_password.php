<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Admin.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	include_once __DIR__ . '/../../bootstrap/jwt_config.php';
	
	$admin = new Admin($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'New Password is required.'];
	}
	if (empty($data->password_confirmation)) {
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Confirm Password is required.'];
	}
	if (!empty($data->password) && strlen($data->password) < 6) {
		$errors[] = (object)['field' => 'password', 'error' => 'New Password must be 6 characters.'];
	}
	
	
	if (!empty($data->password_confirmation) && strlen($data->password_confirmation) < 6) {
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Confirm Password must be 6 characters.'];
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
		$new_password = md5($data->password);
		$password_confirmation = md5($data->password_confirmation);
		
		
		if ($new_password !== $password_confirmation) {
			$errors[] = (object)['field' => "password_confirmation", 'error' => "confirm password does not matched"];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		
		else {
			$changePassword = $admin->changePassword($new_password, $data->confirm_email);
			
			http_response_code(200);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Password Reset successfully done.';
			$response->form = "change_form";
			
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
	