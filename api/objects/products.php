<?php
class Products
{

    // database connection and table name
    private $conn;
    private $table_name = "php_templatephp.products";

    // object properties
    public $id;
    public $name;
    public $price;
    public $status;
    public $location;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
    SELECT id,NAME,price,STATUS,location FROM php_templatephp.products 
    ORDER BY name ASC
    */ 
    // read products
    function read()
    {
        $query = "SELECT ".$this->table_name.".id,
                ".$this->table_name.".name,
                ".$this->table_name.".price,
                ".$this->table_name.".status,
                ".$this->table_name.".location 
                FROM ".$this->table_name." 
                ORDER BY ".$this->table_name.".name ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readStock()
    {
        $query = "SELECT ".$this->table_name.".id,
                ".$this->table_name.".name,
                ".$this->table_name.".price,
                ".$this->table_name.".status,
                ".$this->table_name.".location 
                FROM ".$this->table_name." 
                WHERE STATUS = 'on sale' 
                ORDER BY ".$this->table_name.".name ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, status=:status, location=:location";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->location = htmlspecialchars(strip_tags($this->location));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":location", $this->location);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // used when filling up the update product form
    function readOne()
    {
        // query to read single record
        $query = "SELECT ".$this->table_name.".id,
                ".$this->table_name.".name,
                ".$this->table_name.".price,
                ".$this->table_name.".status,
                ".$this->table_name.".location 
                FROM ".$this->table_name." 
                WHERE ".$this->table_name.".id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of profileapp to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        return $stmt;/*
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->apps_id = $row['apps_id'];
        $this->name = $row['name'];*/
    }



    // update the product
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                status = :status,
                location = :location
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    // delete the product
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        $this->rows_affected = 0;
        if ($stmt->execute()) {
            $this->rows_affected = $stmt->rowCount();
            return true;
        }

        return false;
    }



    // search products
    function search($keywords)
    {

        // select all query
        $query = "SELECT id, name, price, status, location FROM " . $this->table_name . " 
                WHERE id LIKE ? OR name LIKE ? OR price LIKE ? OR status LIKE ? OR location LIKE ? ORDER BY name DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }



    // read products with pagination
    public function readPaging($from_record_num, $records_per_page)
    {

        // select query
        $query = "SELECT id, name, price, status, location FROM " . $this->table_name . " 
                ORDER BY name DESC LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }



    // used for paging products
    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
    
}
