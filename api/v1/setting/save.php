<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Setting.php';

    $database = new Database();
    $db = $database->getConnection();

    $setting = new Setting($db);
	
	$data = json_decode(file_get_contents("php://input"));

	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->name)) {
		$errors[] = (object)['field' => 'name', 'error' => 'System Name is required.'];
	}
	
	if (empty($data->app_version)) {
		$errors[] = (object)['field' => 'app_version', 'error' => 'App Version is required.'];
	}
	
	if (empty($data->mail)) {
		$errors[] = (object)['field' => 'mail', 'error' => 'App Version is required.'];
	}
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 400;
		$response->data = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	try {
		$checkSetting =  $setting->get();
		$count =  $checkSetting->rowCount();
		
		if ($count === 0){
			$setting = $setting->save($data);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Setting save successfully.';
			
		} else{
			$setting = $setting->update($data);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'Setting Update successfully.';
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
