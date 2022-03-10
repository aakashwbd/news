<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if ($data->type === 'select') {
		$errors[] = (object)['field' => 'type', 'error' => 'Please Select Any Types.'];
	}
	
	if ($data->category_type === 'select'){
		$data->category_type = 'non-feature';
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
		$id = $_GET['id'];
		
		$exist_data = $news->getEditData($id);
		$row = $exist_data->fetch(PDO::FETCH_ASSOC);
		
		
		if ($data->type === 'image'){
			$data->link = null;
		}
		
		if (empty($data->title)){
			$data->title = 	$row['title'];
		}
		
		if (empty($data->category)){
			$data->category =  json_decode($row['category_id']);
		}else{
			$data->category =  json_encode($data->category);
		}
		
		
		if (empty($data->description)){
			$data->description = $row['description'];
		}
		
		if (empty($data->logo)){
			$data->logo = $row['image'];
		}
		
	
		
//		var_dump($data);

		$update = $news->update($data, $id);

		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'News Update successfully.';
		http_response_code(200);
//
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