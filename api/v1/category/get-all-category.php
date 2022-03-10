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
		$getAll = $category->getAllCategory();
		$count = $getAll->rowCount();
		
		$response_data = [];
		if ($count !== 0){
			while ($row = $getAll->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$e = array(
					"id" => $id,
					"name" => $name,
					"image"=>$image,
					"status" => $status
				);
				
				$response_data[] = $e;
			}
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			http_response_code(200);
		} else{
			$response->status = 'error';
			$response->status_code = 404;
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
	