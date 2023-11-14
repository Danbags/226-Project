<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/dogs.php';

$database = new Database();
$db = $database->getConnection();

$item = new Dog($db);

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

// employee values
$item->name = $data->name;
$item->owner = $data->owner;
$item->age = $data->age;
$item->breed = $data->breed;

if($item->updateDog()){
    echo json_encode("Dog data updated.");
} else{
    echo json_encode("Data could not be updated");
}
?>