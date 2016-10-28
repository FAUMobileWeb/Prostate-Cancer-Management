<?php
    include_once("redirect-if-logged.php");
    include_once("parser.php");
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
                <li><a  data-rel="back">Back</a></li>
            </ul>
        </div>
    </div>

	<div role="main" class="ui-content">
        <div class="body">
            <h1>Sign Up</h1><br><br>
            
            <form name="signupform" id="signupform" onsubmit="return false;">
                <div>Username: </div>
                <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="100">
                <span id="usernamestatus"></span>
                <div>Email Address:</div>
                <input id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="100">
                <div>Password:</div>
                <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="100">
                <div>Confirm Password:</div>
                <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="100">
                <div>Gender:</div>
                <select id="gender" onfocus="emptyElement('status')">
                    <option value=""></option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select><br><br>
                <button id="signupbtn" onclick="signup()">Create Account</button>
                <span id="status"></span>
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