<?php
    session_Start();

    if (isset($_SESSION['username'])) {
        header("location: app-dash.php");
        exit();
    }
?>
<?php
    if (isset($_POST["u"])) {
        include_once("php_connect.php");
        
        $u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
        $p = crypt($_POST['p'], '$saltlife$');
        
        $ip = preg_replace('#[^0-9.]#', '', getenv('REMOVE_ADDR'));
        
        if ($u == "" || $p == "") {
            echo "login_failed";
            exit();
        } else {
            $sql = "SELECT id, username, password FROM users WHERE username='$u' AND activated='1' LIMIT 1";
            $query = mysqli_query($db, $sql);
            $row = mysqli_fetch_row($query);
            $db_id = $row[0];
            $db_username = $row[1];
            $db_pass_str = substr(substr($row[2], 0, -20), 20);
            if ($p != $db_pass_str) {
                echo "login_failed";
                exit();
            } else {
                $_SESSION['userid'] = $db_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['password'] = $db_pass_str;
                setcookie("id", $db_id, strtotime('+30 days'), "/", "", "", TRUE);
                setcookie("user", $db_username, strtotime('+30 days'), "/", "", "", TRUE);
                setcookie("pass", $row[2], strtotime('+30 days'), "/", "", "", TRUE);
                $sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
                $query = mysqli_query($db, $sql);
                echo $db_username;
                exit();
            }
        }
        exit();
    }
?>