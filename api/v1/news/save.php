<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	
	
	// generate json web token
	include_once __DIR__ . '/../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;
	
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];
	
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->title)) {
		$errors[] = (object)['field' => 'title', 'error' => 'News title is required.'];
	}
	
	if (empty($data->category)) {
		$errors[] = (object)['field' => 'category', 'error' => 'Please Select Any Category.'];
	}
	
	if ($data->type === 'select') {
		$errors[] = (object)['field' => 'type', 'error' => 'Please Select Any Types.'];
	}
	
	if ($data->type === 'video' && empty($data->link)) {
		$errors[] = (object)['field' => 'link', 'error' => 'Link is required.'];
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
		$status = null;
		$decoded = JWT::decode($token, $key, ['HS256']);
		$role = $decoded->data->role;
		
		if ($role === 'superAdmin') {
			$status = 'Active';
		}
		else if ($role === 'manage-admin') {
			$status = 'Inactive';
		}
		
		$save = $news->save($data, $status);
		
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
	