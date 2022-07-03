<?php

//require once the new_config.php
require_once("new_config.php");

class Database {
    public $connection;
    public $db;

    function __construct() {
        $this->db = $this->open_db_connection();
    }


    public function open_db_connection() {
        //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
        //OOP way
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        //if connection fails
        // if(mysqli_connect_errno()) {
        //     //kill script and display the message inside die()
        //     //mysqli_error is the error occurred when connecting
        //     die("Database connection failed badly" . mysqli_error());
        // }
        
        //OOP way
        //connect_errno is a property of mysqli class
        //connect_error is a property of mysqli class
        if($this->connection->connect_errno) {
            //kill script and display the message inside die()
            //mysqli_error is the error occurred when connecting
            die("Database connection failed badly" . $this->connection->connect_error);
        }

        //return connection if it connects
        return $this->connection;

    }
    
    //database query
    public function query($sql) {
        //result
        //connection and the query
        //$result = mysqli_query($this->connection, $sql);

        //OOP way
        $result = $this->db->query($sql);
        $this->confirm_query($result);

        return $result;
    }

    //confirm there is a database query
    private function confirm_query($result) {
        //if there is no result
        // if(!$result) {
        //     die("Query Failed" . mysqli_error($this->connection));
        // }

        //OOP way
        if(!$result) {
            die("Query Failed" . $this->db->error);
        }
    }

    //escapes special characters (NUL (ASCII 0), \n, \r, \, ', ", and Control-Z)
    public function escape_string($string) {
        //$escaped_string = mysqli_real_escape_string($this->connection, $string);
        
        //OOP way
        return $this->db->real_escape_string($string);
    }

    //insert the id of the last query
    public function the_insert_id() {
        //return mysqli_insert_id($this->connection);

        //OOP way
        return $this->db->insert_id;
    }

}

$database = new Database();

?>