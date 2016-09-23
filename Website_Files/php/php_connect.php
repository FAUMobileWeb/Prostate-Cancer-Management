<?php
    $db = mysqli_connect("localhost", "database_username", "database_password", "database_name");

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit();
    }
?>