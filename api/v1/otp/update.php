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
		
		$exist_data = $category->getEditData($id);
		$row = $exist_data->fetch(PDO::FETCH_ASSOC);
		
		$exist_name = $row['name'];
		$exist_image = $row['image'];
		
		$name = $data->name ? $data->name: $exist_name;
		$image = $data->logo ? $data->logo: $exist_image;
		
		$update = $category->update($name, $image, $id);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->success_message = 'Category update successfully.';
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