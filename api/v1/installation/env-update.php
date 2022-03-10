<?php
    include_once __DIR__ . '/../config/database.php';

	$request = json_decode(file_get_contents("php://input"));
	
	$response = (object)['status' => 'success'];
	$errors = [];

	if (!empty($errors)) {
		$response->status = 'validate_error';
		$response->status_code = 422;
		$response->data = $errors;
		http_response_code(422);
		echo json_encode($response);
		die();
	}
	
	try {
        $appVariables = json_decode(file_get_contents(__DIR__ . "/../../../env.json"), true);
		
		
        $data = [
            'APP_NAME'      => $request->app_name ?? $appVariables['APP_NAME'],
            'APP_URL'       => $request->app_url ?? $appVariables['APP_URL'],
            'DB_NAME'       => $request->db_name ?? $appVariables['DB_NAME'],
            'DB_USERNAME'   => $request->db_username ?? $appVariables['DB_USERNAME'],
            'DB_PASSWORD'   => $request->db_password ?? $appVariables['DB_PASSWORD'],
            'DB_HOST'       => $request->db_host ?? $appVariables['DB_HOST'],
        ];

        file_put_contents(__DIR__ . "/../../../env.json", json_encode($data, JSON_PRETTY_PRINT), true);

        if($request->db_name  || $request->db_username || $request->db_password || $request->db_host || $request->db_port){
            $database = new Database();
            $databaseStatus = $database->getConnectionStatus();

            if($databaseStatus['status'] === 'success'){
                $response->status = 'success';
                $response->status_code = 200;
                $response->data = $databaseStatus['message'];
            }else{
                $errors[] = (object)['field' => 'database', 'error' => $databaseStatus['message']];
                $response->status = 'error';
                $response->status_code = 400;
                $response->messages = $errors;
                http_response_code(400);
            }
	        echo json_encode($response);
	        die();
        }

		$response->status = 'success';
		$response->status_code = 200;
		$response->data = 'Env update successfully';
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