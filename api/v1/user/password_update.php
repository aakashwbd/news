<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/User.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	include_once __DIR__ . '/../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;
	
	$user = new User($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	$data = json_decode(file_get_contents("php://input"));
	
	if (!empty($errors)) {
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	
	if (empty($data->current_password)) {
		$errors[] = (object)['field' => 'current_password', 'error' => 'Current Password is required.'];
	}
	
	if (empty($data->new_password)) {
		$errors[] = (object)['field' => 'new_password', 'error' => 'New Password is required.'];
	}
	
	if(!empty($data->new_password) && strlen($data->new_password) < 6){
		$errors[] = (object)['field' => 'new_password', 'error' => 'New Password must be 6 characters.'];
	}
	
	if (empty($data->confirm_password)) {
		$errors[] = (object)['field' => 'confirm_password', 'error' => 'Confirm Password is required.'];
	}
	
	if(!empty($data->confirm_password) && strlen($data->confirm_password) < 6){
		$errors[] = (object)['field' => 'confirm_password', 'error' => 'Confirm Password must be 6 characters.'];
	}
	
	
	try {
		if ($token !== ""){
			
			$decoded = JWT::decode($token, $key, ['HS256']);
			$user_id = $decoded->data->id;
			
			$existUser = $user->getSingleUser($user_id);
			$row = $existUser->fetch(PDO::FETCH_ASSOC);
			
			$exist_password = $row['password'];
			
			$password_hash = md5($data->current_password);
			$new_password = md5($data->new_password);
			$confirm_password = md5($data->confirm_password);
			
			if ($exist_password != $password_hash) {
				$errors[] = (object)['field' => "current_password", 'error' => "Current password does not matched"];
				$response->status = 'error';
				$response->status_code = 400;
				$response->messages = $errors;
				http_response_code(400);
				echo json_encode($response);
				die();
			}else if ($new_password != $confirm_password) {
				$errors[] = (object)['field' => "confirm_password", 'error' => "confirm password does not matched"];
				$response->status = 'error';
				$response->status_code = 400;
				$response->messages = $errors;
				http_response_code(400);
				echo json_encode($response);
				die();
			} else{
				$user = $user->updatePassword($new_password, $user_id);
				
				http_response_code(200);
				
				$response->status = 'success';
				$response->status_code = 200;
				$response->success_message = 'Password Update successfully.';
				
				echo json_encode($response);
			}
			
		}else{
			$errors[] = (object)['field' => "global", 'error' => "you are not authorized"];
			$response->status = 'error';
			$response->status_code = 400;
			$response->messages = $errors;
			http_response_code(400);
			echo json_encode($response);
			die();
		}
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	