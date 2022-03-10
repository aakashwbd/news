<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Notification.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$notification = new Notification($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->app_id)) {
		$errors[] = (object)['field' => 'app_id', 'error' => 'APP ID is required.'];
	}
	
	if (empty($data->api_key)) {
		$errors[] = (object)['field' => 'api_key', 'error' => 'API KEY is required.'];
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
		
		$check = $notification->checkSetting();
		$count =  $check->rowCount();
		
		if ($count === 0){
			$notification = $notification->saveSetting($data);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Notification Setting Save successfully.';
			
		} else{
			$notification = $notification->updateSetting($data);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Notification Setting Update successfully.';
		}
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
