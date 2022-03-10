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
	
	try {
		if ($token !== ""){
			
			$decoded = JWT::decode($token, $key, ['HS256']);
			$user_id = $decoded->data->id;
			
			$existUser = $user->getSingleUser($user_id);
			$row = $existUser->fetch(PDO::FETCH_ASSOC);
			
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
			
			$update = $user->update($data, $user_id);
			
			// set response code
			http_response_code(200);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->success_message = 'User update successfully.';
			echo json_encode($response);
			
		}else{
			$errors[] = (object)['field' => "global", 'error' => "you are not authorized"];
			$response->status = 'error';
			$response->status_code = 400;
			$response->messages = $errors;
			http_response_code(400);
			echo json_encode($response);
			die();
		}
		
//		$id = $_GET['id'];
//
//		$existUser = $user->getSingleUser($id);
//		$row = $existUser->fetch(PDO::FETCH_ASSOC);
//
//		$exist_name = $row['name'];
//		$exist_email = $row['email'];
//		$exist_phone = $row['phone'];
//		$exist_image = $row['image'];
//
		
//		if (empty($data->name)){
//			$data->name = $exist_name;
//		}
//
//		if (empty($data->email)){
//			$data->email = $exist_email;
//		}
//
//		if (empty($data->phone)){
//			$data->phone = $exist_phone;
//		}
//
//		if (empty($data->image)){
//			$data->image = $exist_image;
//		}
//
//		$user = $user->update($data, $id);
//
		
//		// set response code
//		http_response_code(200);
//
//		$response->status = 'success';
//		$response->status_code = 200;
//		$response->success_message = 'User update successfully.';
//		echo json_encode($response);
		
	} catch (CustomException $e) {
		$errors[] = (object)['field' => $e->getField(), 'error' => $e->getMessage()];
		$response->status = 'error';
		$response->status_code = 400;
		$response->messages = $errors;
		http_response_code(400);
		echo json_encode($response);
		die();
	}
	