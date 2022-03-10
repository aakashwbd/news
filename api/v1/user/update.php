<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/User.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	$data = json_decode(file_get_contents("php://input"));
	
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
		
		$existUser = $user->getSingleUser($id);
		$row = $existUser->fetch(PDO::FETCH_ASSOC);
		
		$exist_name = $row['name'];
		$exist_email = $row['email'];
		$exist_phone = $row['phone'];
		$exist_image = $row['image'];
		
		
		if (empty($data->name)){
			$data->name = $exist_name;
		}
		
		if (empty($data->email)){
			$data->email = $exist_email;
		}
		
		if (empty($data->phone)){
			$data->phone = $exist_phone;
		}
		
		if (empty($data->image)){
			$data->image = $exist_image;
		}
		
		$user = $user->update($data, $id);
		
		
		// set response code
		http_response_code(200);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'User update successfully.';
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
	