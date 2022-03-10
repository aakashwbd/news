<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Video.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$video = new Video($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	if (empty($data->title)) {
		$errors[] = (object)['field' => 'title', 'error' => 'Title is required.'];
	}
	if (empty($data->url)) {
		$errors[] = (object)['field' => 'url', 'error' => 'URL is required.'];
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
		$save = $video->save($data);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'Video Save successfully.';
		
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
	