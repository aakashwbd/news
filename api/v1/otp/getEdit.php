<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Category.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$category = new Category($db);
	
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
		$id = $_GET['id'];
		
		
		$getEdit = $category->getEditData($id);
		$count = $getEdit->rowCount();
		
		if ($count !== 0) {
			$row = $getEdit->fetch(PDO::FETCH_ASSOC);
			
			$response_data=[
				"id" => $row['id'],
				"name" => $row['name'],
				"image" => $row['image'],
				"status" => $row['status']
			];
			
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->success_message = 'Language get successfully.';
			$response->data = $response_data;
			http_response_code(200);
		}
		else {
			$response->status = 'error';
			$response->status_code = 400;
			$response->success_message = 'Language get failed.';
			
			http_response_code(400);
		}
		
		
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
	