<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/CustomSMTP.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$smtp = new CustomSMTP($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	
	if (empty($data->host)) {
		$errors[] = (object)['field' => 'host', 'error' => 'HOST is required.'];
	}
	
	if (empty($data->port)) {
		$errors[] = (object)['field' => 'port', 'error' => 'PORT is required.'];
	}
	
	if (empty($data->username)) {
		$errors[] = (object)['field' => 'username', 'error' => 'Username is required.'];
	}
	
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'Password is required.'];
	}
	

	
	if ($data->encryption === 'select') {
		$errors[] = (object)['field' => 'encryption', 'error' => 'Please Select Any.'];
	}
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	
	try {
		$get = $smtp->getSMTP();
		$count = $get->rowCount();

		if ($count !== 0) {
			$save = $smtp->update($data);

			http_response_code(200);

			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'SMTP update successfully.';
		}
		else {
			$save = $smtp->save($data);

			http_response_code(200);

			$response->status = 'success';
			$response->status_code = 200;
			$response->data = 'SMTP save successfully.';

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
