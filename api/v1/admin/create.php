<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Admin.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	
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
	
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'Password is required.'];
	}
	
	$check = $admin->checkExistAdmin($data->email);
	$count = $check->rowCount();
	
	if ($count > 0){
		$errors[] = (object)['field' => 'email', 'error' => 'Admin Already Exist.'];
	}

	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	try {
		$admin = $admin->save($data);
		
		http_response_code(200);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'Admin save successfully.';
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
	