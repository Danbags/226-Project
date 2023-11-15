<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/dogs.php';

$database = new Database();
$db = $database->getConnection();

$items = new Dog($db);

$stmt = $items->getDogs();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);

if($itemCount > 0){

    $dogArr = array();
    $dogArr["body"] = array();
    $dogArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "name" => $name,
            "owner" => $owner,
            "age" => $age,
            "breed" => $breed,
        );

        array_push($dogArr["body"], $e);
    }
    echo json_encode($dogArr);
}


else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>