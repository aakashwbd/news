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
	
//	if (empty($data->code)){
//		$errors[] = (object)['field' => 'code', 'error' => 'Code is required.'];
//	}
	
	$code = implode("",$data->code);
	$email = $data->email;
	
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
		$getOTP = $otp->getOTPforAdmin($code, $email);
		
		if ($row = $getOTP->fetch(PDO::FETCH_ASSOC)) {

			$code = $row['code'];
			$email = $row['email'];
			$created = $row['created_at'];
			$expired = date_create($row['expired_at']);
			
			$expTime = date_format($expired,"d-m-Y h:i:s");
			$currentTime = date('d-m-Y h:i:s', time());
			
			if ($currentTime < $expTime) {
				$response->status = 'success';
				$response->status_code = 200;
				$response->message = "Verified. Go forward for next step.";
				$response->email = $email;
				$response->form = "otp_form";
			}
			else {
				$errors[] = (object)['field' => 'code', 'error' => 'invalid otp'];
				$response->status = 'validate_error';
				$response->status_code = 422;
				$response->data = $errors;
			}
		}
		else {
			$errors[] = (object)['field' => 'code', 'error' => 'OTP does not matched'];
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
	