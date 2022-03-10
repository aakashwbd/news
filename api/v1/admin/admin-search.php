<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Admin.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	$data = json_decode(file_get_contents("php://input"));
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
		$search = $admin->getAdminSearch($data->search);
		
		$count = $search->rowCount();
		
		$response_data = [];
		
		if ($count > 0){
			while ($row = $search->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$e = array(
					"id" => $id,
					"name" => $name,
					"email" => $email,
					"phone" => $phone,
					"image" => $image
				);
				$response_data[] = $e;
			}
		}
		
		// set response code
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


 