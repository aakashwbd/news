<?php
	include_once __DIR__ . "/../../bootstrap/header.php";
	include_once __DIR__ . '/../../config/database.php';
	include_once __DIR__ . '/../../classes/Comment.php';
	include_once __DIR__ . '/../../classes/User.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$comment = new Comment($db);
	$user = new User($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
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
		$getNewsId = $_GET['id'];
		
		$getAll = $comment->getCommentByNewsId($getNewsId);
		$count = $getAll->rowCount();
		
		$response_data = [];
		if ($count !== 0){
			while ($row = $getAll->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				
				$userData = $user->show($user_id);
				
				$e = array(
					"id" => $id,
					"news_id" => $news_id,
					"comment"=>$comment_text,
					"added_on" => date_format(date_create($created_at),"F d,Y"),
				);
				
				if($userData->rowCount()){
				    $userObj = $userData->fetch(PDO::FETCH_ASSOC);
				    
				    $e['user'] = [
				        'name' => $userObj['name'],
				        'image' => $userObj['image']
				    ];
				}
				
				$response_data[] = $e;
			}
			
			$response->status = 'success';
			$response->status_code = 200;
			$response->data = $response_data;
			http_response_code(200);
		} else{
			$response->status = 'error';
			$response->status_code = 404;
			$response->message = 'Data Not Found.';
			$response->data = $response_data;
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
	