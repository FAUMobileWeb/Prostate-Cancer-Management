<?php
    session_start();
    include_once("php_connect.php");

    $user_ok = false;
    $log_id = "";
    $log_username = "";
    $log_password = "";

    function evaluateLoggedUser($db, $id, $u, $p) {
        $sql = "SELECT ip FROM users WHERE id='$id' AND username='$u' AND password='$p' AND activated='1' LIMIT 1";
        $query = mysqli_query($db, $sql);
        $numrows = mysqli_num_rows($query);
        
        if ($numrows == 0) {
            return true;
        }
    }

    if(isset($_SESSION["userid"]) && isset($_SESSION["username"]) && isset($_SESSION["password"])) {
        $log_id = preg_replace('#[^0-99]#', '', $_SESSION['userid']);
        $log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
        $log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
        
        $user_ok = evaluateLoggedUser($db, $log_id, $log_username, $log_password);
    } else if (isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
        $_SESSION['userid'] = preg_replace('#[^0-99]#', '', $_COOKIE['id']);
        $_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
        $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
        
        $log_id = $_SESSION['userid'];
        $log_username = $_SESSION['username'];
        $log_password = $_SESSION['password'];
        
        $user_ok = evaluateLoggedUser($db, $log_id, $log_username, $log_password);
        
        if ($user_ok == true) {
            $sql = "UPDATE users SET lastlogin=now() WHERE id='$log_id' LIMIT 1";
            $query = mysqli_query($db, $sql);
        }
    }
?>