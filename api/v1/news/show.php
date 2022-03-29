<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	include_once __DIR__ . '/../classes/View.php';
	
	include_once __DIR__ . '/../classes/Favourite.php';
	
	include_once __DIR__ . "/../bootstrap/jwt_config.php";
	
	use Firebase\JWT\JWT;
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	$view = new View($db);
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
		$id = $_GET['id'];

		$viewSave = $view->newsViwesave($id);

		$singleNewsShow = $news->singleNewsShow($id);
		// $row = $singleNewsShow->fetch(PDO::FETCH_ASSOC);
		// var_dump($row);

		$count = $singleNewsShow->rowCount();

	
		
		if ($count !== 0) {
			$row = $singleNewsShow->fetch(PDO::FETCH_ASSOC);
			
			$isFavorite = false;
				
			if($token){
			    $decoded = JWT::decode($token, $key, ['HS256']);
			    
			    if($decoded){
			        $user_id = $decoded->data->id;
			        $favouriteData = $favourite->isFavorite($row['id'], $user_id);
			        $favouriteObj = $favouriteData->fetch(PDO::FETCH_ASSOC);
			        
			        if($favouriteObj){
			            $isFavorite = true;
			        }
			    }
			}
			
			$data=[
				"id" => $row['id'],
				"news_type" => $row['type'],
				"video_type"=> $row['video_type'],
				"category" => json_decode($row['category_id']),
				"title" => $row['title'],
				"description" => $row['description'],
				"video_link" => $row['link'],
				"image" => $row['image'],
				"status" => $row['status'],
				"added_on" => date_format(date_create($row['created_at']),"F d,Y"),
				'is_favorite' => $isFavorite
			];
			
			$response_data = $data;
// 			$response_data[] = $row;

		    
		    $response_data['view_news_count'] = (int) $view->newsViewCount($id);
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			http_response_code(200);
		}
		else {
			$response->status = 'error';
			$response->status_code = 404;
			$response->success_message = 'Data Not Found.';
			
			http_response_code(404);
		}
		
		
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
	