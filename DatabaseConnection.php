<?php

/**
 * Class Name: DatabaseConnection
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to establish a connection to a remote database and handle queries.
 * Explanation of important functions: The constructor uses hardcoded database information to call the connect method to
 * establish a connection to a cleardb mysql database (setters can be used to change attribute values to connect to a
 * different database). The queryDB method is also very important, it accepts a string (the mysql query statement) and
 * returns FALSE for a failed query or a mysqli_result object if the query was successful.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

class DatabaseConnection {

    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    # constructor defines connection to clearDB on Bluemix
    function __construct(){
        $this->servername = "us-cdbr-sl-dfw-01.cleardb.net";
        $this->username = "b8e24747489532";
        $this->password = "1a2a9e6a";
        $this->dbname = "ibmx_fe83c219896edb4";
        $this->connect();
    }

    # constructor defines connection to clearDB on Bluemix
    function __destruct(){
        $this->disconnect();
    }

    function getServername(){
        return $this->servername;
    }

    function getUsername(){
        return $this->username;
    }

    function getPassword(){
        return $this->password;
    }

    function getDbname(){
        return $this->dbname;
    }

    function getConnection(){
        return $this->conn;
    }

    function setConnection($connection){
         $this->conn = $connection;
    }

    function connect(){
        // check if connection has already been made, if not then make connection
        if(!$this->getConnection()){
            $this->setConnection(new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname()));
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
    }

    function disconnect(){
        $this->getConnection()->close();
    }

    # receives an SQL command, processes the command through the $conn variable then returns the result
    function queryDB($sql){
        if($result = $this->getConnection()->query($sql)){
            echo "worked out";
        }
        else{
            echo "nah";
        }
        return $result;
    }

    function getDBInstance(){
        if(!isset($this->conn)){
            $this->connect();
        }
        return $this->connect();
    }
}
?>
