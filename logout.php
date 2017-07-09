<?php
/**
 * Class Name: None
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This module logs the user out of their account
 * Explanation of important functions: None.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

require("User.php");

    session_start();

    unset($_SESSION['user']);
    $_SESSION['user'] = new User();

    header('Location:/online-marketplace/index.php');

