<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/User.php';
	include_once __DIR__ . '/../../classes/Mail.php';
	include_once __DIR__ . '/../../classes/OTP.php';
	include_once __DIR__ . '/../../classes/CustomSMTP.php';
	
	
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	$mail = new Mail();
	$otp = new OTP($db);
	$customSMTP= new CustomSMTP($db);
	
	//	$data = json_decode(file_get_contents("php://input"));
	
	
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
		$email = $_GET['email'];
		
		$getSMTP = $customSMTP->getSMTP();
		$fetchSMTP = $getSMTP->fetch(PDO::FETCH_ASSOC);
		
		$host = $fetchSMTP['host'];
		$port = $fetchSMTP['port'];
		$username = $fetchSMTP['username'];
		$mail_password = $fetchSMTP['password'];
		
		$setFrom = $fetchSMTP['email'];
		$addAddress = $email;
		
		$subject = 'your otp is';
		
		$code = rand(100000, 999999);
		
		$body = $code;
		
		$delete = $otp->delete($email);
		
		$time_created = date("h:i:s", time());
		$time_expires = date("h:i:s", time() + 3600);
		
		if ($delete){
			$check = $user->getEmail($email);
			$count = $check->rowCount();
			
			if ($count !== 0) {
				$row = $check->fetch(PDO::FETCH_ASSOC);
				
				$checkOTP = $otp->checkByEmail($email);
				
				if ($checkOTP) {
					$deleteOTP = $otp->delete($email);
					$saveOTP = $otp->save($code, $email, $time_created, $time_expires);
					$sendMail = $mail->mailerFunction($host, $port, $username, $mail_password, $setFrom, $addAddress, $subject, $body);
					$response->status_code = 200;
					$response->message = 'Resend Your OTP in Your Email';
					$response->email = $email;
					echo json_encode($response);
				}
			}
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
	