<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Video.php';
	
	include_once __DIR__ . '/../classes/Favourite.php';
	
	include_once __DIR__ . "/../bootstrap/jwt_config.php";
	
	use Firebase\JWT\JWT;
	
	$database = new Database();
	$db = $database->getConnection();
	
	$video = new Video($db);
	$favourite = new Favourite($db);
	
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
		$data = null;

		if (isset($_GET['date'])){
			$data = $_GET['date'];
		}
		
		
		$getAll = $video->getByDate($data);
		$count = $getAll->rowCount();
		
		$response_data = [];
		if ($count !== 0) {
			while ($row = $getAll->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				
				$isFavorite = false;
				
				if ($token) {
					$decoded = JWT::decode($token, $key, ['HS256']);
					
					if ($decoded) {
						$user_id = $decoded->data->id;
						$favouriteData = $favourite->isFavorite($id, $user_id);
						$favouriteObj = $favouriteData->fetch(PDO::FETCH_ASSOC);
						
						if ($favouriteObj) {
							$isFavorite = true;
						}
					}
				}
				
				$e = [
					"id" => $id,
					"news_type" => $type,
					"category_id" => json_decode($category_id),
					"title" => $title,
					"description" => $description,
					"video_link" => $link,
					"image" => $image,
					"status" => $status,
					"added_on" => date_format(date_create($created_at), "F d,Y")
				];
				
				$response_data[] = $e;
				// $response_data[] = $row;
			}
		}
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
	