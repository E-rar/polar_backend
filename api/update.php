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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // entry values
    $item->topic = $data->topic;
    $item->body = $data->body;
    $item->epic = $data->epic;
    $item->color = $data->color;
    $item->asignee = $data->asignee;
    $item->argument = $data->argument;
    
    if($item->updateEntry()){
        echo json_encode("Entry data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>