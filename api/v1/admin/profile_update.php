<?php
	include_once __DIR__."/../bootstrap/header.php";
	include_once __DIR__.'/../config/database.php';
	include_once __DIR__.'/../classes/Admin.php';;
	
	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Admin($db);
	
	// generate json web token
	include_once __DIR__ . '/../bootstrap/jwt_config.php';
	
	use Firebase\JWT\JWT;
	
	$data = json_decode(file_get_contents("php://input"));
	
	$headers = apache_request_headers();
	$token = $headers['Authorization'];
	
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
		if ($token){
			$decoded = JWT::decode($token, $key, ['HS256']);
			
			$id = $decoded->data->id;
			$exist_data = $admin->getById($id);
			
			$row = $exist_data->fetch(PDO::FETCH_ASSOC);
			
			$exist_name = $row['name'];
			$exist_email = $row['email'];
			$exist_phone = $row['phone'];
			$exist_image = $row['image'];
			
			if (empty($data->name)){
				$data->name = $exist_name;
			}
			
			if (empty($data->email)){
				$data->email = $exist_email;
			}
			
			if (empty($data->phone)){
				$data->phone = $exist_phone;
			}
			
			if (empty($data->image)){
				$data->image = $exist_image;
			}
			$response_data = [];
			if($admin = $admin->updateProfile($data, $id)) {
				
				$response_data = [
					"id" => $id,
					"email" => $data->email,
					"name" => $data->name,
					"phone" => $data->phone,
					"image" => $data->image,
				];
				$jwt = JWT::encode($token, $key);
				$token = [
					"iat" => $issued_at,
					"exp" => $expiration_time,
					"iss" => $issuer,
					"data" => $response_data
				];
				$response_data['token'] = $jwt;
				
			}
			
			http_response_code(200);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->success_message = 'Admin Update successfully.';
			$response->data = $response_data;
			echo json_encode($response);
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
	