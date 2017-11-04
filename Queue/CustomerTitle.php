<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
// Request status
include_once '../config/Api.php';
include_once '../objects/CustomerTitle.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$Title = new CustomerTitle($db);
 
// query Titles
$stmt = $Title->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // Title array
    $Title_arr=array();
    $Title_arr["titles"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Title_item=array(
            "id" => $id,
            "Title" => $Title
        );
 
        array_push($Title_arr["titles"], $Title_item);
    }
 
    echo json_encode($Title_arr);
}
 
?>