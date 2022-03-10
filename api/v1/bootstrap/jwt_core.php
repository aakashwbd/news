<?php
	// show error reporting
	error_reporting(E_ALL);
	
	// set your default time-zone
	date_default_timezone_set('Asia/Manila');
	
	// variables used for jwt
	$key = "radio_app_0001";
	$issued_at = time();
	$expiration_time = $issued_at + (60 * 60) * 24; // valid for 1 day
	$issuer = "http://localhost/global_template";