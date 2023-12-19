<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Hypercars.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Hypercars($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleHypercars();

    if($item->id != null){
        // create array
        $emp_arr = array(
            "id" => $item->id,
            "Manufacturer" =>  $item->Manufacturer,
            "Model" => $item->Model,
            "Price" => $item->Price,
        );
      
        http_response_code(200);
        echo json_encode($hyp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Vehicle not found.");
    }
?>