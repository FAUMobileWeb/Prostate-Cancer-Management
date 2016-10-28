<!DOCTYPE html>
<html>
<head>
	<title>Prostate Cancer</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    
    <link type="text/css" rel="stylesheet" href="../css/stylesheet.css">
    <link type="text/css" rel="stylesheet" href="../css/app.css">
    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="../js/js_mods.js"></script>
</head>

<body>
    
<div id="background"></div>
    
<div data-role="page" id="dashboard">
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
    <div class="ui-body-b ui-body">
        <div data-role="navbar">
            <ul>
                <li><a href="../prostate-cancer.html#home" rel="external">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="../prostate-cancer.html#about" rel="external">About</a></li>
            </ul>
        </div>
    </div>
    
    <div role="main" class="ui-content">
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
                        <br>
                        <button onclick="logout()">Logout</button>
                        ';
                }
            ?>
        </div>
    </div>
    
    <div role="footer" class="center">
        <div class="ui-body-b ui-body center inline-block border-radius">
            <button onclick="toggleFullScreen()">Fullscreen</button>
        </div>
    </div>
</div>

</body>
</html>