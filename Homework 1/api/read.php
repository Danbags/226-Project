<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/Hypercars.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Hypercars($db);

    $stmt = $items->getHypercars();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "Make" => $Make,
                "Model" => $Model,
                "Top Speed" => $TopSpeed,
                "Price" => $Price,
                "designation" => $designation,
                "created" => $created
            );

            array_push($hypercarsArr["body"], $e);
        }
        echo json_encode($hypercarsArr);
    }


    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>