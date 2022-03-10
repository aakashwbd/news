<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/User.php';
	include_once __DIR__ . '/../../classes/Mail.php';
	include_once __DIR__ . '/../../classes/OTP.php';


	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	$mail = new Mail();
	$otp = new OTP($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	// validate object
	$response = (object)['status' => 'success'];
	$errors = [];
	
	$host = 'smtp.mailtrap.io';
	$port = '2525';
	$username = '417210714e4051';
	$mail_password = '0d98881139c7ec';
	
	$setFrom = 'aakash.wbd@gmail.com';
	$addAddress = $data->email;
	
	$subject = 'your otp is';
	
	$code = rand(100000, 999999);
	
	$body = $code;
	
	$time_created = date("h:i:s", time());
	$time_expires = date("h:i:s", time() + 3600);
	
	
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
		$check = $user->getEmail($data->email);
		$count = $check->rowCount();
		
		if ($count !== 0) {
			$row = $check->fetch(PDO::FETCH_ASSOC);
			
			//			$id = $row['id'];
			//			$email   = $row['email'];
			//			$password = $row['password'];
			
			$checkOTP = $otp->checkByEmail($data->email);
			
			if ($checkOTP) {
				$deleteOTP = $otp->delete($data->email);
				$saveOTP = $otp->save($code, $data->email, $time_created, $time_expires);
				$sendMail = $mail->mailerFunction($host, $port, $username, $mail_password, $setFrom, $addAddress, $subject, $body);
				$response->status_code = 200;
				$response->message = 'code send your email, please check your email.';
				$response->email = $data->email;
				echo json_encode($response);
				
				//				header("Location: $server/api/v1/auth/user/user-verify.php", true, 301);
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
	