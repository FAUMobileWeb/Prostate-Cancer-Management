<?php
    include_once("parser.php");
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
        <script src="../js/js_mods.js"></script>
    </head>

    <body>
        <nav class="NavMenu">
            <div class="NavItem"><a href="../index.html">Home</a></div>
            <div class="NavItem"><a href="../app-dash.html">Dash</a></div>
            <div class="NavItem"><a href="../app-about.html">About</a></div>
        </nav>
        
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
        
    </body>
</html>
