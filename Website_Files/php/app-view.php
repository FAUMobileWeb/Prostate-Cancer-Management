<?php
    include_once("check_login_status.php");
?>

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
    <div class="ui-body-b ui-body">
        <div data-role="navbar">
            <ul>
                <li><a href="../prostate-cancer.html#home" rel="external">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="../prostate-cancer.html#about" rel="external">About</a></li>
            </ul>
        </div>
    </div>
    
    <div role="main" class="ui-content">
        <script>search('');</script>
        
        <div class="body">
            <h1>View Data</h1><br><br>
            
            <input class="search-button" onkeyup="search(this.value)" type="search" name="search" id="search" value="" />
            <br>

            <div id="data">
                
            </div>
        </div>
    </div>
    
    <div data-role="popup" id="popup" data-overlay-theme="a" data-corners="false" data-tolerance="30,15">
    </div>
    
    <div role="footer" class="center">
        <div class="ui-body-b ui-body center inline-block border-radius">
            <a href="../index.html" rel="external" class="no-decoration">Lamp Home Page</a>
            <button onclick="toggleFullScreen()">Fullscreen</button>
        </div>
    </div>
</div>
    
</body>
</html>