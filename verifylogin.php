<?php

require("DatabaseConnection.php");

# @TODO fix this to make database connection persistent
    $db = new DatabaseConnection();

    $email = $_POST["email"];
    $pword = $_POST["password"];

    if ($email || $pword) {
        $result = $db->queryDB("SELECT * FROM users where email = '" . $email . "' and password = '" . $pword . "';");
        if ($result && $result->num_rows == 1) {
            header('Location: sucessful.php');
        }
        else {
            #todo make sure that user is notified that login failed
            header('Location: login.php/?retry=false');
        }
    }