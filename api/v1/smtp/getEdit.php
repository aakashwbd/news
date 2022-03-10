<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/CustomSMTP.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$smtp = new CustomSMTP($db);
	
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
		
		$get = $smtp->getSMTP();
		$count = $get->rowCount();
		
		if ($count !== 0) {
			$row = $get->fetch(PDO::FETCH_ASSOC);
			
		
			
			$response_data[] = $row;
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			http_response_code(200);
		}
		else {
			$response->status = 'error';
			$response->status_code = 404;
			$response->data = 'Data Not Found.';
			
			http_response_code(404);
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
	