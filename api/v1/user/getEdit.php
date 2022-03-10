<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/User.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	try {
		$id = $_GET['id'];
		
		$user = $user->getSingleUser($id);
		$row = $user->fetch(PDO::FETCH_ASSOC);
		
		$data = [
			"name"=>$row['name'],
			"email"=>$row['email'],
			"phone"=>$row['phone'],
			"image"=>$row['image'],
		];
		$response_data[] =$data;
		
		http_response_code(200);
		$response->status = 'success';
		$response->status_code = 200;
		$response->success_message = 'User Get successfully.';
		$response->data = $response_data;
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
