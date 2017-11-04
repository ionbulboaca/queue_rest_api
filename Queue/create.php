<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
// Request status
include_once '../config/Api.php';
// instantiate Queu object
include_once '../objects/Queue.php';
 
$database = new Database();
$db = $database->getConnection();
 
$Queue = new Queue($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set Queue property values
$Queue->FirstName = $data->FirstName;
$Queue->LastName  = $data->LastName;
$Queue->Name      = $data->Name;
$Queue->service_id = $data->service;
$Queue->customer_type_id  = $data->type;
$Queue->customer_title_id = $data->title; 

// create the queue
if($Queue->insert()){
    echo '{';
        echo '"message": "Customer was created."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to isert customer."';
    echo '}';
}
?>