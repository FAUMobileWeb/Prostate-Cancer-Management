<?php
    include_once("logincheck.php");
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
            <div class="NavItem"><a href="../prostate-cancer.html">Home</a></div>
            <div class="NavItem"><a href="app-dash.php">Dash</a></div>
            <div class="NavItem"><a href="../app-about.html">About</a></div>
        </nav>
        
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
        
    </body>
</html>
