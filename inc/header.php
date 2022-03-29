<?php
	$hosts = $_SERVER['REQUEST_SCHEME'] ? $_SERVER['REQUEST_SCHEME'] : 'http' .'://'. $_SERVER['HTTP_HOST'];
	$asset = $hosts . "/assets/";
	$url = $hosts."/admin/";

    // $hosts = $_SERVER['REQUEST_SCHEME'];
	// $asset = $hosts . '://'. $_SERVER['HTTP_HOST']. "/assets/";
	// $url = $hosts . '://'. $_SERVER['HTTP_HOST']. "/admin/";
 
	
	require_once __DIR__.'/../api/v1/classes/InstallChecker.php';
	$install = new InstallChecker();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>News</title>
    <!-- Favicons -->
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= $asset ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $asset ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $asset ?>vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- select 2 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    <!-- toaster css -->
    <link href="<?= $asset ?>css/toastr.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= $asset ?>css/style.css" rel="stylesheet">

    <!-- Auto Complete CSS  -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.6/dist/css/autoComplete.02.min.css">


    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

    <!--    Drop Zone CSS-->
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css"/>


</head>

<body>
<div id="preloader" class="d-none">
    <div id="status">
    </div>
</div>