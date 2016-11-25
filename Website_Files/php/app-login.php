<?php
    include_once("redirect-if-logged.php");
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
    
<div data-role="page">
    <div class="ui-body-b ui-body">
        <div data-role="navbar">
            <ul>
                <li><a data-rel="back">Back</a></li>
            </ul>
        </div>
    </div>

	<div role="main" class="ui-content">
        <div class="body">
            <h1>Login</h1><br><br>

            <form id="loginform" onsubmit="return false;">
                <div>Username:</div>
                <input type="text" id="username" onfocus="emptyElement('status')" maxlength="100">
                <div>Password:</div>
                <input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
                <br>
                <button id="loginbtn" onclick="login()">Log In</button>
                <br>
                <p id="status"></p>
                <br>
                <a href="#">Forgot Your Password?</a>
            </form>
        </div>
    </div>
    
    <div role="footer" class="center">
        <div class="ui-body-b ui-body center inline-block border-radius">
            <a href="index.html" rel="external" class="no-decoration">Lamp Home Page</a>
            <button onclick="toggleFullScreen()">Fullscreen</button>
        </div>
    </div>
</div>
    
</body>
</html>
