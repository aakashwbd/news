<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../class/User.php';
	
	// generate json web token
	include_once __DIR__.'/../config/core.php';
	include_once __DIR__.'/../libs/php-jwt-master/src/BeforeValidException.php';
	include_once __DIR__.'/../libs/php-jwt-master/src/ExpiredException.php';
	include_once __DIR__.'/../libs/php-jwt-master/src/SignatureInvalidException.php';
	include_once __DIR__.'/../libs/php-jwt-master/src/JWT.php';
	use \Firebase\JWT\JWT;
	
	$database = new Database();
	$db = $database->getConnection();
	
	$item = new User($db);
	
	// get posted data
	$data = json_decode(file_get_contents("php://input"));
	
 
	// posted email & password
	$item->user_email = $data->email;
	$password = md5($data->password);
	
	//	exist email & password
	$email_exists = $item->emailExists();
	$password_exist = $item->user_password;
	
	if ( empty($item->user_email) || empty($password) ){
		echo json_encode([
             "status" => "error",
             "message" => "Email & Password Required.",
		]);
	}else if($email_exists){
		if($password === $password_exist){
			$token = array(
				"iat" =>  $issued_at,
				"exp" =>  $expiration_time,
				"iss" => $issuer,
				"data" => array(
					"user_id" => $item->user_id,
					"user_name" => $item->user_name
				)
			);
			
			// set response code
			http_response_code(200);
			
			// generate jwt
			$jwt = JWT::encode($token, $key);
			
			echo json_encode(
				array(
					"status" => "success",
					"message" => "Successful login.",
					"jwt" => $jwt
				)
			);
		}else{
			echo json_encode(
				array(
					"status" => "error",
					"message" => "password did not matched."
				)
			);
		}
	}else{
		// set response code
		http_response_code(401);
		
		// tell the user login failed
		echo json_encode(array("message" => "Login failed."));
	}
	