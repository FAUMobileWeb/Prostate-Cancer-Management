<?php
    $db = mysqli_connect("localhost", "db_username", "db_password", "db_name");

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit();
    }
?>