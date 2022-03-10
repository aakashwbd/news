<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Comment.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$comment = new Comment($db);
	
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
		$id = $_GET['id'];
		
		$delete = $comment->deleteNewsComment($id);
		$response->status = 'success';
		$response->status_code = 200;
		$response->success_message = 'News Comment delete successfully.';
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