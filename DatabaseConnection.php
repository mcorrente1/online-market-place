<?php

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
            else {
                echo "Successfully connected to database <br>";
            }
        }
    }

    function disconnect(){
        $this->getConnection()->close();
    }

    # receives an SQL command, processes the command through the $conn variable then returns the result
    function queryDB($sql){

        echo $sql;

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