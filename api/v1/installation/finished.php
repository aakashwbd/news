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
    if (!file_exists(__DIR__.'/../../../assets/vendor/installed')) {
        file_put_contents(__DIR__.'/../../../assets/vendor/installed', 'installed');
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