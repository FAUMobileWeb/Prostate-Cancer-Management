<?php
    session_start();
    $_SESSION = array();

    if (isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
        unset($_COOKIE["id"]);
        unset($_COOKIE["user"]);
        unset($_COOKIE["pass"]);
        setcookie("id", null, -1, '/');
        setcookie("user", null, -1, '/');
        setcookie("pass", null, -1, '/');
    }

    session_destroy();
    
    if (isset($_SESSION['username'])) {
        header("location: message.php?msg=Error:_Logout_Failed");
    } else {
        header("location: http://lamp.cse.fau.edu/~edossantos2014/prostate-cancer.php");
        exit();
    }
?>