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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="http://cdn.jtsage.com/jtsage-datebox/4.0.0/jtsage-datebox-4.0.0.bootstrap.min.css" />
    <link rel="stylesheet" href="http://dev.jtsage.com/DateBox/css/syntax.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://cdn.jtsage.com/external/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="http://dev.jtsage.com/DateBox/js/doc.js"></script>
    <script type="text/javascript" src="http://cdn.jtsage.com/jtsage-datebox/4.0.0/jtsage-datebox-4.0.0.bootstrap.min.js"></script>
    <script type="text/javascript" src="http://cdn.jtsage.com/jtsage-datebox/i18n/jtsage-datebox.lang.utf8.js"></script>
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
        <div class="body">
            <h1>Upload Data</h1><br><br>
            
            <div id="uploadContent">
                <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" data-ajax=false>
                    <label for="basic">Enter Title of Data Entry:</label>
                    <input type="text" name="title" id="titleInput" value="" required/>
                    
                    <label for="basic">Enter The Date:</label>
                    <input type="date" data-role="datebox" name="date" data-options='{"mode": "datebox", "overrideDateFormat": "%m/%d/%Y"}' required/>
                    
                    <label for="basic">Enter Your Weight:</label>
                    <input type="text" name="weight" id="weightInput" value="" onblur="checkWeight()" required/>

                    <label for="basic">Select Images to Upload:</label>
                    <div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-c">
                        <input type="file" name="fileInput[]" id="fileInput" onchange="checkFileType()" multiple class="ui-input-text ui-body-c" required>
                    </div>
                    <div id="filesSize"></div>

                    <br>

                    <input id="uploadbtn" type="submit" value="Submit">
                    <strong id="status"></strong>
                </form>
            </div>
            
        </div>
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