<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	
	$response = (object)['status' => 'success'];
	$errors = [];

	// if (empty($data->title)) {
	// 	$errors[] = (object)['field' => 'search', 'error' => 'News title is required.'];
	// }
	
	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->messages = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
		$search = $news->searchNews($data);
		$count = $search->rowCount();
		
		$response_data = [];
		
		if ($count !== 0){
			while ($row = $search->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$e = array(
					"id" => $id,
					"type" => $type,
					"category_id"=>$category_id,
					"title" => $title,
					"description" => $description,
					"video_link" => $link,
					"image" => $image,
					"status" => $status
				);

				$response_data[] = $e;
			}

			$response->status = 'success';
			$response->status_code = 200;
			$response->success_message = 'News Search successfully.';
			$response->data = $response_data;
			http_response_code(200);

		} else{
			$response->status = 'error';
			$response->status_code = 404;
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
	