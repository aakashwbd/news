<?php
	include_once __DIR__ . "/../bootstrap/header.php";
	include_once __DIR__ . '/../config/database.php';
	include_once __DIR__ . '/../classes/Category.php';
	include_once __DIR__ . '/../classes/News.php';
	include_once __DIR__ . '/../classes/Video.php';
	include_once __DIR__ . '/../classes/Report.php';
	include_once __DIR__ . '/../classes/Admin.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$category = new Category($db);
	$news = new News($db);
	$video = new Video($db);
//	$report = new Report($db);
	$admin = new Admin($db);
	
	
	$response = (object)['status' => 'success'];
	$errors = [];
	
	
	try {
		$category_all = $category->getAll();
		$category_count = $category_all->rowCount();
		
		$newsAll = $news->getAll();
		$news_count = $newsAll->rowCount();
		
		$activeNews = $news->getByActive();
		$active_news_count = $activeNews->rowCount();
		
		$getVideo = $video->getAll();
		$video_count = $getVideo->rowCount();
		
//		$getReport = $report->getAll();
//		$report_count = $getReport->rowCount();
		
		$getAdmin = $admin->get();
		$admin_count = $getAdmin->rowCount();
		
		$response_data = [
			"Category" => $category_count,
			"News" => $news_count,
			"Approved" => $active_news_count,
			"Video" => $video_count,
//			"Report" => $report_count,
			"Admin" => $admin_count,
		];
		
		

		http_response_code(200);
		
		$response->status = 'success';
		$response->status_code = 200;
		$response->success_message = 'Favourite get successfully.';
		$response->data = $response_data;
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
	