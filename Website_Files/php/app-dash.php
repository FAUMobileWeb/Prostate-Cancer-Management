<?php
    include_once("check_login_status.php");
    // Initialize any variables that the page might echo
    $u = "";
    $sex = "Male";
    $userlevel = "";
    $joindate = "";
    $lastsession = "";

    // Select the member from the users table
    if ($user_ok == true) {        
        $u = $log_username;
        $sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";
        $user_query = mysqli_query($db, $sql);
        // Now make sure that user exists in the table
        $numrows = mysqli_num_rows($user_query);
        if($numrows < 1){
            echo "That user does not exist or is not yet activated, press back";
            exit();	
        }

        // Fetch the user row from the query above
        while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
            $profile_id = $row["id"];
            $gender = $row["gender"];
            $userlevel = $row["userlevel"];
            $signup = $row["signup"];
            $lastlogin = $row["lastlogin"];
            $joindate = strftime("%b %d, %Y", strtotime($signup));
            $lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
            if($gender == "f"){
                $sex = "Female";
            }
        }
    }
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">         
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
        <title>Prostate Cancer</title>
        <link type="text/css" rel="stylesheet" href="../css/stylesheet.css">
        <link type="text/css" rel="stylesheet" href="../css/app.css">
        
        <script src="../js/jquery-3.1.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery-3.1.0.min.js"><\/script>')</script>
        <script src="../js/code.js"></script>
    </head>

    <body>
        <nav class="NavMenu">
            <div class="NavItem"><a href="../index.html">Home</a></div>
            <div class="NavItem"><a href="app-dash.php">Dash</a></div>
            <div class="NavItem"><a href="../app-about.html">About</a></div>
        </nav>
        
        <div class="body">
            <h1>Dashboard</h1><br><br>
            
            <?php
                if ($user_ok == false) {
                    echo '<a href="app-login.php"><div class="button">Log In</div></a>
                    <a href="app-signup.php"><div class="button">Sign Up</div></a>';
                } else {
                    echo '
                        <strong>
                            <p style="font-size:1.2em;">Welcome '.$u.'</p><br>
                            <a href="app-upload.php">Upload Data</a><br>
                            <a href="app-upload.php">View Data</a><br>
                            <a href="app-upload.php">Data Results</a><br>
                            <a href="app-upload.php">Edit Settings</a>
                        </strong>
                        ';
                }
            ?>
        </div>
        
    </body>
</html>
