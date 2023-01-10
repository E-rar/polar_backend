<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/entry.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Entry($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleEntry();
    if($item->topic != null){
        // create array
        $ent_arr = array(
            "id" => $item->id,
                "topic" => $item->topic,
                "body" => $item->body,
                "epic" => $item->epic,
                "color" => $item->color,
                "asignee" => $item->asignee,
                "argument" => $item->argument
        );
      
        http_response_code(200);
        echo json_encode($ent_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Entry not found.");
    }
?>