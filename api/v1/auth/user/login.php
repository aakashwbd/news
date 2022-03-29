<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../util/custom_exception.php';
	
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/User.php';
	
	include_once __DIR__ . "/../../bootstrap/jwt_config.php";
	
	use Firebase\JWT\JWT;
	
	
	
	//	sleep(3);
	
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	
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
	if (empty($data->password)) {
		$errors[] = (object)['field' => 'password', 'error' => 'Password is required.'];
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
		$getEmail = $user->getEmail($data->email);
		
		if ($getEmail->rowCount() == 0) {
		    $errors[] = (object)['field' => "email", 'error' => "The selected email is invalid"];
		    $response->status = 'validate_error';
    		$response->status_code = 422;
    		$response->data = $errors;
    		http_response_code(422);
    		echo json_encode($response);
    		die();
// 			throw new CustomException("email", "Please register from this email first.");
		} else {
			$row = $getEmail->fetch(PDO::FETCH_ASSOC);
			$id = $row['id'];
			$name = $row['name'];
			$email = $row['email'];
			$phone = $row['phone'];
			$image = $row['image'];
			$password = $row['password'];
		}
		
		
		$password_hash = md5($data->password);
		
		if ($password != $password_hash) {
			$errors[] = (object)['field' => "password", 'error' => "Password does not matched."];
			$response->status = 'validate_error';
			$response->status_code = 422;
			$response->data = $errors;
			http_response_code(400);
			echo json_encode($response);
			die();
		}
		
		// Generating Data Object
		$response_data = [
			'user' => $row
		];
		
		$tokenData = [
			'id' => $row['id'],
			'role' => 'user',
		];
		
		// Generating Token
		$token = [
			"iat" => $issued_at,
			"exp" => $expiration_time,
			"iss" => $issuer,
			"data" => $tokenData
		];
		// Generate JWT
		$jwt_token = JWT::encode($token, $key);
		
		$response_data['token'] = $jwt_token;
		
		// set response code
		http_response_code(200);
		$response->status = 'success';
		$response->status_code = 200;
		$response->data = $response_data;
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
