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
		$response_data = null;
		$getSetting = $setting->getSingleData();
		$count = $getSetting->rowCount();
		
		if ($count > 0){
			$row = $getSetting->fetch(PDO::FETCH_ASSOC);
			
			$data = [
				'id'=> $row['id'],
				"system_name" => $row['system_name'],
				"app_version" => $row['app_version'],
				"mail_address" => $row['email'],
				"update_app" => $row['update_app'],
				"developed_by" => $row['developed_by'],

				"facebook" => $row['facebook_link'],
				"instagram" => $row['instagram_link'],
				"twitter" => $row['twitter_link'],
				"youtube" => $row['youtube_link'],

				"logo" => $row['logo'],
				"copyright" => $row['copyrights'],

				"description" => $row['description'],
				"privacy_policy" => $row['privacy_policy'],
				"cookies_policy" => $row['cookies_policy'],
				"terms_policy" => $row['terms_policy']
			];
			
			$response_data = $data;
		}
		
		
		
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
