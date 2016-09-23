<?php
    include_once("php_connect.php");

    $table_users = "CREATE TABLE IF NOT EXISTS users (
                    id INT(10) NOT NULL AUTO_INCREMENT,
                    username VARCHAR(16) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    gender ENUM('m', 'f') NOT NULL,
                    userlevel ENUM('admin', 'user') NOT NULL DEFAULT 'user',
                    avatar VARCHAR(255) NULL,
                    ip VARCHAR(255) NOT NULL,
                    signup DATETIME NOT NULL,
                    lastlogin DATETIME NOT NULL,
                    notescheck DATETIME NOT NULL,
                    activated ENUM('0', '1') NOT NULL DEFAULT '0',
                    PRIMARY KEY (id),
                    UNIQUE KEY username (username, email)
                    )";

    $query = mysqli_query($db, $table_users);
    
    if ($query === TRUE) {
        echo "<h3>users table sucessfuly created!</h3>";
    } else {
        echo "<h3>users table failed to create!</h3>";
    }

    $table_useroptions = "CREATE TABLE IF NOT EXISTS useroptions (
                    id INT(10) NOT NULL,
                    username VARCHAR(16) NOT NULL,
                    question VARCHAR(255) NULL,
                    answer VARCHAR(255) NULL,
                    PRIMARY KEY (id),
                    UNIQUE KEY username (username)
                    )";

    $query = mysqli_query($db, $table_useroptions);
    
    if ($query === TRUE) {
        echo "<h3>useroptions table sucessfuly created!</h3>";
    } else {
        echo "<h3>useroptions table failed to create!</h3>";
    }
?>