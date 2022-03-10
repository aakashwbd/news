<?php
	
	$request = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];

    if (empty($request->code)) {
        $errors[] = (object)['field' => 'code', 'error' => 'Please enter the valid code.'];
    }

	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
        $url = 'https://license.projectx.com.bd/license-check';
        $data = array("code" => $request->code);
        $postdata = json_encode($data);

//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//        $result = curl_exec($ch);
//        curl_close($ch);
//
//        $result = json_decode($result);

        $result = ['status' => 'success'];

        if($result->status === 'success' || $result['status'] === 'success'){
            $response->status = 'success';
            $response->status_code = 200;

            if (!file_exists(__DIR__.'/../../../assets/vendor/licensed')) {
                file_put_contents(__DIR__.'/../../../assets/vendor/licensed', 'licensed');
            }
        }else if($result->status === 'validate_error'){
            $response->status = 'validate_error';
            $response->status_code = 422;
            $response->data = [
                ['field' => 'code', 'error' => $result->data->code]
            ];
            http_response_code(422);
            echo json_encode($response);
            die();
        } else if($result->status === 'server_error'){
            $response->status = 'error';
            $response->status_code = 400;
            $response->data = $result->message;
            echo json_encode($response);
            die();
        } else{
            $response->status = 'error';
            $response->status_code = 400;
        }
        $response->data = $result['message'];
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