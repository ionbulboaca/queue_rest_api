<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Service.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$Service = new Service($db);
 
// query Services
$stmt = $Service->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // Service array
    $Service_arr=array();
    $Service_arr["services"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Service_item=array(
            "id" => $id,
            "Name" => $Name
        );
 
        array_push($Service_arr["services"], $Service_item);
    }
 
    echo json_encode($Service_arr);
}
 
?>