<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
// Request status
include_once '../config/Api.php';
include_once '../objects/CustomerType.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$Type = new CustomerType($db);
 
// query Types
$stmt = $Type->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // Type array
    $Type_arr=array();
    $Type_arr["types"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Type_item=array(
            "id" => $id,
            "Name" => $Name
        );
 
        array_push($Type_arr["types"], $Type_item);
    }
 
    echo json_encode($Type_arr);
}
 
?>