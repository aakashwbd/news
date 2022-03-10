<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/News.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$news = new News($db);
	
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
		$category_id = $_GET['id'];
		
		$getAll = $news->getAllByCategory($category_id);
		$count = $getAll->rowCount();
//		var_dump($getAll);
//		var_dump($count);
		

		$response_data = [];
		if ($count !== 0){
			while ($row = $getAll->fetch(PDO::FETCH_ASSOC)){
//				extract($row);
//				$e = array(
//					"id" => $id,
//					"type" => $type,
//					"category_id"=>$category_id,
//					"title" => $title,
//					"description" => $description,
//					"link" => $link,
//					"image" => $image,
//					"status" => $status
//				);

				$response_data[] = $row;
			}

			$response->status = 'success';
			$response->status_code = 200;
			$response->success_message = 'News all get successfully.';
			$response->data = $response_data;
			http_response_code(200);
		} else{
			$response->status = 'error';
			$response->status_code = 400;
			$response->success_message = 'News all get failed.';
			$response->data = $response_data;
			http_response_code(400);
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
	