<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/entry.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Entry($db);
    $stmt = $items->getEntrys();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $entryArr = array();
        $entryArr["data"] = array();
        $entryArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "topic" => $topic,
                "body" => $body,
                "epic" => $epic,
                "color" => $color,
                "asignee" => $asignee,
                "argument" => $argument
            );
            array_push($entryArr["data"], $e);
        }
        echo json_encode($entryArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>