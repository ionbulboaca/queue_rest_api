<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Queue.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$queue = new Queue($db);
 
// query queue_list
$stmt = $queue->QueueList();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // queue array
    $queue_arr=array();
    $queue_arr["queue_list"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $queue_item=array(
            "id" => $id,
            "Name" => $Name,
            "Service" => $Service,
            "Queued_AT" => $Queued_AT,
            "Type" => $Type
        );
 
        array_push($queue_arr["queue_list"], $queue_item);
    }
 
    echo json_encode($queue_arr);
}
 
else{
    echo json_encode(
        array("message" => "No queue found.")
    );
}
?>