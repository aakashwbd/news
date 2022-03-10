<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Notification.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$notification = new Notification($db);
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	try {
		
		$get = $notification->getNotificationSetting();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		
		$data = [
			"app_id"=>$row['app_id'],
			"api_key"=>$row['api_key']
		];
		
		$response_data[]= $data;
		
		http_response_code(200);
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = $response_data;
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
