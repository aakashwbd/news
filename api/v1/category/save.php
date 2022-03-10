<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Category.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$category = new Category($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->name)) {
		$errors[] = (object)['field' => 'name', 'error' => 'Category Name is required.'];
	}
	if ($check = $category->check($data->name)) {
		$errors[] = (object)['field' => 'name', 'error' => 'This Category Already Exists.'];
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
		$save = $category->save($data);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'Category Save successfully.';
		
		http_response_code(200);
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
	