<?php

require_once("new_config.php");

class Database
{

    public $connection;

    function __construct()
    {
        $this->openDbConnection();
    }

    public function openDbConnection()
    {
        // use the DB_* constants defined in new_config.php (without quotes)
        //$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_errno) {
            // mysqli_connect_error() returns the connection error message
            die("Database Connection failed: " . $this->connection->connect_error );
        }
    }

    public function query($sql)
    {

        //$result = mysqli_query($this->connection, $sql);
        $result = $this->connection->query($sql);

        $this->confirmQuery($result);

        return $result;
    }



    private function confirmQuery($result)
    {

        if (!$result) {
            die("Query Failed" . $this->connection->error);
        }

    }

    public function escapeString($string)
    {

        //$escaped_string = mysqli_real_escape_string($this->connection, $string);
        $escaped_string =$this->connection->real_escape_string($string);

        return $escaped_string;
    }


    public function theInsertId() {
        //return mysqli_insert_id($this->connection);
        return $this->connection->insert_id;

    }

    public function insert_id () {
        return mysqli_insert_id($this->connection);
    }

}


$database = new Database();





?>