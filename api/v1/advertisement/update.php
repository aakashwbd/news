<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/User.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new User($db);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['update_user'])){

        $item->user_id = $_GET['update_user'];

        $item->user_name = $_POST['user_name'];
        $item->user_email = $_POST['user_email'];
        $item->user_phone = $_POST['user_phone'];
        $item->user_password = md5($_POST['new_password']);
       

        var_dump($item->user_id);
        var_dump($item->user_email);
        var_dump($item->user_name);
        var_dump($item->user_phone);
        var_dump($item->user_password);
        die;

        if($_FILES){
            $permited  = array('jpg', 'jpeg', 'png', 'gif');

            $file_name = $_FILES['news_image']['name'];
            $file_size = $_FILES['news_image']['size'];
            $file_temp = $_FILES['news_image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "../../uploads/".$unique_image;

            $item->news_image =  $uploaded_image; 
        }

        // var_dump($item->news_image);
        // die;
       
        // $item->news_type = $_POST['category_name'];

        if(empty($item->news_category) || empty($item->news_title) || empty($item->news_video_link) || empty($item->news_description)){
            echo json_encode([
                "status" => "error",
                "message" => "All fields are required!!!"
            ]);
        } else{
           
            if(!empty($file_name)) {   
                  
                if ($file_size >10048567) { 
                    echo json_encode([
                        "status" => "error",
                        "message" => "Image Size should be less then 10MB!"
                    ]);
                } else if (in_array($file_ext, $permited) === false) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "You can upload only:-"
                        .implode(',', $permited).""
                    ]);
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);

                    if($item->updateNewsImage()){
                        echo json_encode([
                            'status' => 'success',
                            "message" => "Country Image Update Sucessfully."
                        ]);
                    } else{
                        echo json_encode([
                            'status' => 'error',
                            "message" => "Country Image Update unsuccess."
                        ]);
                    }
                }
            } else{

                
                if($item->updateNews()){
                    echo json_encode([
                        'status' => 'success',
                        "message" => "Country Update Sucessfully."
                    ]);
                } else{
                    echo json_encode([
                        'status' => 'error',
                        "message" => "country update unsuccess."
                    ]);
                }
            }
        
        }
    }
    
    // acitve status update
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //     $item->category_id = $_POST['id'];
    //     $item->active_status = $_POST['status'];

    //     // var_dump($item->category_id);
    //     // var_dump( $item->active_status);
    //     // die;


    //     if($item->updateStatus()){

    //         if($item->active_status === 'active'){
    //             echo json_encode([
    //                 'status' => 'active',
    //                 "message" => "Language Active"
    //             ]);
    //         } else if($item->active_status === 'inactive'){
    //             echo json_encode([
    //                 'status' => 'inactive',
    //                 "message" => "Language inActive"
    //             ]);
    //         }
    //     } else{
    //         echo json_encode([
    //             'status' => 'error',
    //             "message" => "Language update unsuccess."
    //         ]);
    //     }
 
    // }
    // employee values

    
   


    // if($_SERVER['REQUEST_METHOD'] === 'PUT'){

    //     $permited  = array('jpg', 'jpeg', 'png', 'gif');
    //     $file_name = $_FILES['category_image']['name'];
    //     $file_size = $_FILES['category_image']['size'];
    //     $file_temp = $_FILES['category_image']['tmp_name'];
        
        
    //     $div = explode('.', $file_name);
    //     $file_ext = strtolower(end($div));
    //     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    //     $uploaded_image = "uploads/".$unique_image;
       
    //     $item->category_name = $_POST['category_name'];
    //     $item->category_image =  $uploaded_image; 
       
        
    //     if($item->createCategory()){
    //         echo json_encode([
    //             'status' => 'success',
    //             "message" => "Language UPdate Sucessfully."
    //         ]);
    //     } else{
    //         echo json_encode([
    //             'status' => 'error',
    //             "message" => "Language update unsuccess."
    //         ]);
    //     }
    
    // }
    
    // $data = json_decode(file_get_contents("php://input"));
    
    
?>