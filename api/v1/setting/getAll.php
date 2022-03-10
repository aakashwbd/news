<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Setting.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$setting = new Setting($db);

	$response = (object)['status' => 'success'];
	$errors = [];
	
	try {
		
		$setting = $setting->getSingleData();
		$row = $setting->fetch(PDO::FETCH_ASSOC);
		
		$data = [
			"name" => $row['system_name'],
			"app_version" => $row['app_version'],
			"mail" => $row['email'],
			"update_app" => $row['update_app'],
			"developed_by" => $row['developed_by'],
			
			"facebook_link" => $row['facebook_link'],
			"instagram_link" => $row['instagram_link'],
			"twitter_link" => $row['twitter_link'],
			"youtube_link" => $row['youtube_link'],
			
			"image" => $row['logo'],
			"copyright" => $row['copyrights'],
			
			"description" => $row['description'],
			"privacy_policy" => $row['privacy_policy'],
			"cookies_policy" => $row['cookies_policy'],
			"terms_policy" => $row['terms_policy']
		];
		
		$response_data[] = $data;
		
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
