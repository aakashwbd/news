<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Admin.php';
	include_once __DIR__ . '/../../classes/Mail.php';
	include_once __DIR__ . '/../../classes/OTP.php';
	include_once __DIR__ . '/../../classes/CustomSMTP.php';
	
//	$server = $_SERVER['HTTP_HOST'];
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	$mail = new Mail();
	$otp = new OTP($db);
	$customSMTP = new CustomSMTP($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	if (empty($data->email)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is required.'];
	}
	
	if (!empty($data->email) && !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = (object)['field' => 'email', 'error' => 'Email is invalid.'];
	}
	
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
		$getSMTP = $customSMTP->getSMTP();
		$fetchSMTP = $getSMTP->fetch(PDO::FETCH_ASSOC);
		
		$host = $fetchSMTP['host'];
		$port = $fetchSMTP['port'];
		$username = $fetchSMTP['username'];
		$mail_password = $fetchSMTP['password'];
		$encryption = $fetchSMTP['encryption'];
		$setFrom = $fetchSMTP['username'];
		$addAddress = $data->email;
		$subject = 'your otp is';
		$code = rand(100000, 999999);
		$body = $code;
		
		$time_created = date("h:i:s", time());
		$time_expires = date("h:i:s", time() + 3600);
		
		
		$check = $admin->checkExistAdmin($data->email);
		$count = $check->rowCount();
		
		if ($count !== 0) {
			$checkOTP = $otp->checkByEmail($data->email);
			if ($checkOTP) {
				$deleteOTP = $otp->delete($data->email);
				$saveOTP = $otp->save($code, $data->email, $time_created, $time_expires);
				$sendMail = $mail->mailerFunction($host, $port, $username, $mail_password, $encryption, $setFrom, $addAddress, $subject, $body);
				
				$response->status_code = 200;
				$response->message = 'code send your email, please check your email.';
				$response->email = $data->email;
				$response->form = 'email_form';
				echo json_encode($response);
				
			}
			else {
				echo 'false';
			}
			
		}
		else {
			$errors[] = (object)['field' => 'email', 'error' => 'This email not found'];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(422);
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
	