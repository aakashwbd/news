<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/OTP.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$otp = new OTP($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$code = implode("", $data->code);
	
	$timezone = "Asia/Dhaka";
	
	if (function_exists('date_default_timezone_set')) {
		date_default_timezone_set($timezone);
	}
	
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
		$getOTP = $otp->getOTP($code);
		$count = $getOTP->rowCount();
		
		if ($count !== 0) {
			$row = $getOTP->fetch(PDO::FETCH_ASSOC);
			$exist_email = $row['email'];
			$exist_code = $row['code'];
			$created_at = $row['created_at'];
			$expired_at = $row['expired_at'];
			
			$current_time = date("h:i:s", time());
			
			if ($exist_code === $code && $current_time < $expired_at) {
				
				
//				var_dump($time);
//				var_dump($expired_at);
				
				$response_data = [
					'email' => $exist_email,
					'form' => 'otp_form'
				];
				
				$response->status = 'success';
				$response->status_code = 200;
				$response->success_message = 'OTP matched successfully.';
				$response->data = $response_data;
				http_response_code(200);
				
				echo json_encode($response);
			}
			else {
				echo 'code is expired';
			}
		}
		else {
			echo 'code not matched';
			
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
	