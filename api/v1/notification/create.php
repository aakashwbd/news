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
	
	if (empty($data->title)) {
		$errors[] = (object)['field' => 'title', 'error' => 'Notification Title is required.'];
	}
	
	if (empty($data->description)) {
		$errors[] = (object)['field' => 'description', 'error' => 'Notification Description is required.'];
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
		$getNotificationSetting = $notification->getNotificationSetting();
		$row = $getNotificationSetting->fetch(PDO::FETCH_ASSOC);

		$exist_app_id = $row['app_id'];
		$exist_api_key =$row['api_key'];

		if ($notificationSave = $notification->saveNotification($data)){
			$title = $data->title;
			$description = $data->description;
			$external_link = $data->link;
			$imageUrl = $data->logo;
			$api_id =$exist_app_id;
			$api_key= $exist_api_key;
			$notificationMessage = $notification->sendMessage($title, $description, $external_link, $imageUrl, $api_id, $api_key);


			http_response_code(200);

			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Notification save successfully.';

			echo json_encode($response);
		}
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
