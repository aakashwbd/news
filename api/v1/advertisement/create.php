<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ . '/../config/database.php';
    include_once __DIR__ . '/../classes/Advertisement.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Advertisement($db);

    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
		
        $ad_type = $_POST['ad_type'];
        $status = $_POST['status'];
        $banner_id = $_POST['banner_id'];
        $banner_link = $_POST['banner_link'];
        $banner_image = $_POST['banner_image'];
		
        $interstitial_id = $_POST['interstitial_id'];
        $interstitial_link = $_POST['interstitial_link'];
        $interstitial_click = $_POST['interstitial_click'];
        $interstitial_image = $_POST['interstitial_image'];
		
        $native_id = $_POST['native_id'];
        $native_link = $_POST['native_link'];
        $native_per_news = $_POST['native_per_news'];
        $native_per_video = $_POST['native_per_video'];
        $native_image = $_POST['native_image'];
		
        $startup_id = $_POST['startup_id'];
      
		
		
		$data = [];
		
		//empty check
	    if (!empty($ad_type)) {
		    foreach ($ad_type as $adType) {
			    $data[$adType]['ad_type']    = $adType;
			    $data[$adType]['created_at'] = date('Y-m-d H:i:s');
			    $data[$adType]['updated_at'] = date('Y-m-d H:i:s');
		    }
	    }

	    if (!empty($status)) {
		    foreach (json_decode($status) as $adType => $statusItem) {
			    $data[$adType]['status'] = $statusItem ? $statusItem : '';
		    }
	    }

	    if (!empty($banner_id)) {
		    foreach ($banner_id as $adType => $banner) {
			    $data[$adType]['banner_id'] = $banner ? $banner : null;
		    }
	    }

	    if (!empty($banner_link)) {
		    foreach ($banner_link as $adType => $bannerLink) {
			    $data[$adType]['banner_link'] = $bannerLink ? $bannerLink: null;
		    }
	    }
		
		if (!empty($banner_image)) {
		    foreach ($banner_image as $adType => $bannerImage) {
			    $data[$adType]['banner_image'] = $bannerImage ? $bannerImage: null;
		    }
	    }

	    if (!empty($interstitial_id)) {
		    foreach ($interstitial_id as $adType => $interstitialId) {
			    $data[$adType]['interstitial_id'] = $interstitialId ? $interstitialId : null;
		    }
	    }

	    if (!empty($interstitial_link)) {
		    foreach ($interstitial_link as $adType => $interstitialLink) {
			    $data[$adType]['interstitial_link'] = $interstitialLink ? $interstitialLink : null;
		    }
	    }

	    if (!empty($interstitial_click)) {
		    foreach ($interstitial_click as $adType => $interstitialClick) {
			    $data[$adType]['interstitial_click'] = $interstitialClick ? $interstitialClick : 0;
		    }
	    }
		
		if (!empty($interstitial_image)) {
		    foreach ($interstitial_image as $adType => $interstitialImage) {
			    $data[$adType]['interstitial_image'] = $interstitialImage ? $interstitialImage : 0;
		    }
	    }

	    if (!empty($native_id)) {
		    foreach ($native_id as $adType => $nativeId) {
			    $data[$adType]['native_id'] = $nativeId ? $nativeId : null;
		    }
	    }

	    if (!empty($native_link)) {
		    foreach ($native_link as $adType => $nativeLink) {
			    $data[$adType]['native_link'] = $nativeLink ? $nativeLink : null;
		    }
	    }

	    if (!empty($native_per_news)) {
		    foreach ($native_per_news as $adType => $nativePerNews) {
			    $data[$adType]['native_per_news'] = $nativePerNews ? $nativePerNews : 0;
		    }
	    }
		
		if (!empty($native_per_video)) {
		    foreach ($native_per_video as $adType => $nativePerVideo) {
			    $data[$adType]['native_per_video'] = $nativePerVideo ? $nativePerVideo : 0;
		    }
	    }
		
		if (!empty($native_image)) {
		    foreach ($native_image as $adType => $nativeImage) {
			    $data[$adType]['native_image'] = $nativeImage ? $nativeImage : 0;
		    }
	    }
	
	    if (!empty($startup_id)) {
		    foreach ($startup_id as $adType => $startupId) {
			    $data[$adType]['startup_id'] = $startupId ? $startupId : null;
		    }
	    }
	
		
	    $check = $item->getAdvertisement();
		$rowCount = $check->rowCount();
		
		if($rowCount === 0){
			foreach ($data as $column) {
				$item->create($column);
			}
			echo json_encode([
	             'status' => 'success',
	             "message" => "Advertisement Create Successful."
			]);
		}else{

			foreach ($data as $column) {
				$item->update($column);
			}
			echo json_encode([
                 'status' => 'success',
                 "message" => "Advertisement Update Successful."
			]);
		}
	
    
    }
