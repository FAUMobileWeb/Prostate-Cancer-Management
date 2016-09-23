<?php
    $message = "";
    $msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
    if($msg == "activation_failure"){
        $message = '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
    } else if($msg == "activation_success"){
        $message = '<h2>Activation Success</h2> Your account is now activated.<br> <a href="app-login.php">Click here to log in</a>';
    } else {
        $message = $msg;
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
            <div class="NavItem"><a href="../app-dash.html">Dash</a></div>
            <div class="NavItem"><a href="../app-about.html">About</a></div>
        </nav>
        
        <div class="body">
            <h1>Message</h1><br><br>

            <p><?php   echo $message;  ?></p><br><br>
            
            <a href="../index.html"><div class="button">Home</div></a>
        </div>
        
    </body>
</html>
