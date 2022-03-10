<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Admin.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
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
		$id = $_GET['id'];
		
		$existAdmin = $admin->getById($id);
		$row = $existAdmin->fetch(PDO::FETCH_ASSOC);
		
//		$exist_name = ;
//		$exist_email = ;
//		$exist_phone = ;
//		$exist_image = ;
//		$exist_role = $row['role'];
//		$exist_access = ;
//
		
		if (empty($data->name)){
			$data->name = $row['name'];
		}
		
		if (empty($data->phone)){
			$data->phone = $row['phone'];
		}
		
		if (empty($data->access)){
			$data->access = $row['access'];
		}else{
			$data->access = json_encode($data->access);
		}
		
		if ($data->role === 'superAdmin'){
			$data->access = null;
		}
		
		if (empty($data->image)){
			$data->image = $row['image'];
		}
	
//		var_dump($data);
		$update = $admin->update($data, $id);
		
		
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
	