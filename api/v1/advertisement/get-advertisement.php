<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Advertisement.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$advertisement = new Advertisement($db);
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	try {
		$response_data = [];
		
		$get = $advertisement->getAdvertisement();
		$itemCount = $get->rowCount();
		
		if ($itemCount > 0) {
			while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$e = [
					"id" => $id,
					"ad_type" => $ad_type,
					"status" => $status,
					"banner_id" => $banner_id,
					"banner_link" => $banner_link,
					"banner_image" => $banner_image,
					"interstitial_id" => $interstitial_id,
					"interstitial_link" => $interstitial_link,
					"interstitial_click" => $interstitial_click,
					"interstitial_image" => $interstitial_image,
					"native_id" => $native_id,
					"native_link" => $native_link,
					"native_per_news" => $native_per_news,
					"native_per_video" => $native_per_video,
					"native_image" => $native_image,
					"startup_id" => $startup_id
				];
				
				$response_data[] = $e;
			}
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