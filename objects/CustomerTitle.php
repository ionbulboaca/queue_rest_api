<?php
class CustomerTitle extends Api{
 
    // database connection and table name
    private $conn;
    private $table_name = "customer_title";
    // object properties
    public $id;
    public $Title;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function Read(){

        // select all query
        $query = "SELECT 
                        * 
                FROM 
                    " . $this->table_name . "
                ORDER BY 
                    id ASC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
}