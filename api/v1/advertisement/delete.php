<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/Country.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Country($db);

    if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['del_news_id'])){
        // var_dump($_GET);
        // die;

        $item->news_id = $_GET['del_news_id'];

       
    
        if($item->deleteNews()){
            echo json_encode([
                'status' => 'success',
                "message" => "Language Delete Sucessfully."
            ]);
        } else{
            echo json_encode([
                'status' => 'error',
                "message" => "Language Delete unSucessfully."
            ]);
        }
    }
    
    
?>