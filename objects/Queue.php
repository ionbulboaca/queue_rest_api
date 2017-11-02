<?php
class Queue{
 
    // database connection and table name
    private $conn;
    private $table_name = "queue_list";
 
    // object properties
    public $id;
    public $Name;
    public $FirstName;
    public $LastName;
    public $service_id;
    public $customer_type_id;
    public $customer_title_id;
    public $queued_at;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function QueueList(){
 
    // select all query
        $query = "SELECT
                        q.id,
                        t.Name AS Type,
                        IF(
                            t.id = 1,
                            CONCAT(
                                ct.Title,
                                ' ',
                                q.FirstName,
                                ' ',
                                q.LastName
                            ),
                            IF(
                                t.id = 2,
                                q.Name,
                                t.Name
                            )
                        ) AS Name,
                        s.Name AS Service,
                        TIME_FORMAT(q.queued_at, '%h:%i') AS `Queued_AT`
                    FROM
                        " . $this->table_name . " q
                        LEFT JOIN
                            customer_title ct
                                ON q.customer_title_id = ct.id
                        LEFT JOIN
                            customer_type t
                                ON q.customer_type_id = t.id
                        LEFT JOIN
                            services s
                                ON q.service_id = s.id
                        WHERE
                            DATE(q.queued_at) = CURDATE()";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
    // Insert Customer
    function insert(){

        if(!in_array($this->customer_type_id, [2, 3])){
            $custom_title =",customer_title_id=:customer_title_id";    
        }else{
            $custom_title ="";
        }
         
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . " 
                    SET 
                    FirstName=:FirstName, LastName=:LastName, Name=:Name, service_id=:service_id, customer_type_id=:customer_type_id " . $custom_title;
     
        // prepare query
        $stmt = $this->conn->prepare($query);

        if(!in_array($this->customer_type_id, [2, 3])){
            $this->customer_title_id = htmlspecialchars(strip_tags($this->customer_title_id));
            $stmt->bindParam(":customer_title_id", $this->customer_title_id);
        }

        // sanitize
        $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
        $this->LastName = htmlspecialchars(strip_tags($this->LastName));
        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->service_id = htmlspecialchars(strip_tags($this->service_id));
        $this->customer_type_id = htmlspecialchars(strip_tags($this->customer_type_id));
        
        // bind values
        $stmt->bindParam(":FirstName", $this->FirstName);
        $stmt->bindParam(":LastName", $this->LastName);
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":service_id", $this->service_id);
        $stmt->bindParam(":customer_type_id", $this->customer_type_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }else{
           return false;
        }
    }
}