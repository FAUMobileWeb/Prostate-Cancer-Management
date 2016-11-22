<?php
    $db = mysqli_connect("localhost", "edossantos2014", "Er415263!@#", "edossantos2014");

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit();
    }
?>