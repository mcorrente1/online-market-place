<?php

require("User.php");

    session_start();

    unset($_SESSION['user']);
    $_SESSION['user'] = new User();

    header('Location:/online-marketplace/index.php');

