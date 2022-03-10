<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	include_once __DIR__ . '/../classes/Category.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	$category = new Category($db);
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->messages = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
		$response_data = [];
		$id = $_GET['id'];
		
		$getEdit = $news->getEditData($id);
		$count = $getEdit->rowCount();

		if ($count !== 0) {
			$row = $getEdit->fetch(PDO::FETCH_ASSOC);

			$response_data[] = $row;
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			http_response_code(200);
		}
		else {
			$response->status = 'error';
			$response->status_code = 404;
			$response->message = 'Data Not Found.';
			$response->data = $response_data;
			
			http_response_code(404);
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
	