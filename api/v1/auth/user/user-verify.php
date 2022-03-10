<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/User.php';
	include_once __DIR__ . '/../../classes/OTP.php';
	
	$server = $_SERVER['HTTP_HOST'];
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	$otp = new OTP($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	$timezone = "Asia/Dhaka";
	if (function_exists('date_default_timezone_set')) {
		date_default_timezone_set($timezone);
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
		$getOTP = $otp->getOTP($data);
		
		if ($row = $getOTP->fetch(PDO::FETCH_ASSOC)) {
			$code = $row['code'];
			$email = $row['email'];
			$created = $row['created_at'];
			$expired = $row['expired_at'];
			
			$expTime = strtotime($expired);
			$currentTime = strtotime(time());
			
			if ($expTime > $currentTime) {
				$response->status = 'success';
				$response->status_code = 200;
				$response->message = "User verified. Go forward for next step.";
//				header("Location: $server/api/v1/auth/user/change-password.php", true, 301);
			}
			else {
				$errors[] = (object)['field' => 'validation_code', 'error' => 'invalid otp'];
				$response->status = 'validate_error';
				$response->status_code = 422;
				$response->data = $errors;
			}
		}
		else {
			$errors[] = (object)['field' => 'validation_code', 'error' => 'OTP does not matched'];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
		}
		echo json_encode($response);
		die();
		
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	