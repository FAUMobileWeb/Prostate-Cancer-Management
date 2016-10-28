<?php
    $message = "";
    $msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
    if($msg == "activation_failure"){
        $message = '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
    } else if($msg == "activation_success"){
        $message = '<h2>Activation Success</h2> Your account is now activated.';
    } else {
        $message = $msg;
    }
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
                <li><a href="../prostate-cancer.html#home" rel="external">Home</a></li>
                <li><a href="../prostate-cancer.html#dashboard" rel="external">Dashboard</a></li>
                <li><a href="../prostate-cancer.html#about" rel="external">About</a></li>
            </ul>
        </div>
    </div>

	<div role="main" class="ui-content">
        <div class="body">
            <h1>Message</h1><br><br>

            <p><?php   echo $message;  ?></p><br><br>
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