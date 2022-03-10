<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Report.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$report = new Report($db);
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (!empty($errors)) {
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	try {
		$getAll = $report->getAllVideoReport();
		$count = $getAll->rowCount();
		
		$response_data = [];
		if ($count !== 0){
			while ($row = $getAll->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$e = array(
					"id" => $report_id,
					"video_title" => $title,
					"user_name" => $name,
					"report_text"=>$report_text,
					"report_status"=>$report_status,
				);
				
				$response_data[] = $e;
			}
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->message = 'Report get successfully.';
			$response->data = $response_data;
			http_response_code(200);
		} else{
			$response->status = 'error';
			$response->status_code = 400;
			$response->success_message = 'Report get failed.';
			$response->data = $response_data;
			http_response_code(400);
		}
		
		
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
	