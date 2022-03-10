<?php
	include_once __DIR__."/../../bootstrap/header.php";
	include_once __DIR__.'/../../config/database.php';
	include_once __DIR__.'/../../classes/User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->name)) {
		$errors[] = (object)['field' => 'name', 'error' => 'Name is required.'];
	}
	
	if (empty($data->email)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is required.'];
	}
	
	if (!empty($data->email) && !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is invalid.'];
	}
	
	if (empty($data->phone)) {
		$errors[] = (object)['field' => 'phone', 'error' => 'Phone is required.'];
	}
	
	if (!empty($data->phone) && strlen($data->phone) < 11) {
		$errors[] = (object)['field' => 'phone', 'error' => 'Phone must be 11 characters.'];
	}
	
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'Password is required.'];
	}
	if(!empty($data->password) && strlen($data->password) < 6){
		$errors[] = (object)['field' => 'password', 'error' => 'Password must be 6 characters.'];
	}
	if(empty($data->password_confirmation)){
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Confirm password is required.'];
	}
	
	if(!empty($data->password_confirmation) && strlen($data->password_confirmation) < 6){
		$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Password confirmation must be 6 characters.'];
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
		$check = $user->getByEmail($data->email);
		
		if ($check) {
			$errors[] = (object)['field' => 'email', 'error' => 'The email has already been taken.'];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		
		$password = $data->password;
		$password_confirmation = $data->password_confirmation;
		
		if ($password !== $password_confirmation) {
			$errors[] = (object)['field' => 'password_confirmation', 'error' => 'Password confirmation does not matched.'];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
			echo json_encode($response);
			die();
		}
		$user = $user->save($data);
		
		// set response code
		http_response_code(200);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'Registration Successfully Done.';
		echo json_encode($response);
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	