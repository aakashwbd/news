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
	
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
		$id = $_GET['id'];
		
		$exist_data = $video->getEditData($id);
		$row = $exist_data->fetch(PDO::FETCH_ASSOC);
		
		$exist_title = $row['title'];
		$exist_url = $row['url'];
		$exist_description = $row['description'];
		$exist_image = $row['image'];
		$exist_video_type = $row['video_type'];
		
		$title = $data->title ? $data->title : $exist_title;
		$url = $data->url ? $data->url : $exist_url;
		$description = $data->description ? $data->description : $exist_description;
		$image = $data->logo ? $data->logo: $exist_image;
		$video_type = $data->video_type ? $data->video_type: $exist_video_type;
		
		$update = $video->update($video_type, $title,$url, $description, $image, $id);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'update successfully';
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