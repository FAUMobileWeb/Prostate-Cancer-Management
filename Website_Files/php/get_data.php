<?php
    session_start();

    if (isset($_POST["s"])) {
        require_once('php_connect.php');
        
        $user_id = $_SESSION['userid'];
        $string = $_POST['s'];
        
        $words = explode(" ",$string);

        $wordCount = count($words);

        $firstWord = "%".$words[0]."%";

        $sql = "SELECT id, title, weight, timestamp FROM data WHERE (CONVERT( title USING utf8 ) LIKE '$firstWord') OR (CONVERT( weight USING utf8 ) LIKE '$firstWord')";

        if($wordCount>1)
        {
            for($i=1; $i<$wordCount; $i++)
            {
                $wordToConvert = "%".$words[$i]."%";
                $sql .= "OR (CONVERT( title USING utf8 ) LIKE '$wordToConvert') or (CONVERT( weight USING utf8 ) LIKE '$firstWord')";
            }
        }
        $sql .= " ORDER BY timestamp DESC";
        
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));
        
        $row_data = [];
        $rows = "";
        $row_num = 0;
        
        while ($data = mysqli_fetch_assoc($query)) {
            $id = $data['id'];
            $title = $data['title'];
            $weight = $data['weight'];
            
            $timestamp = strtotime($data['timestamp']);
            $date = date('m-d-Y', $timestamp);
            
            $time = date('G:i', $timestamp);
            
            $new_item = "<p>Title: $title</p><p>Weight: $weight</p><p>Date Submitted: $date</p><p>Time Submitted: $time</p>";
                
            $new_item .= "<a href='#popup' id='image-link-$id' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline'>View Images</a>";
            
            array_push($row_data, $new_item);
            
            $rows .= "<button class='ui-btn ui-btn-b' onclick='openData($row_num, $id)'>$title</button>
                        <div id='display_$row_num' style='display: none;'>$row_data[$row_num]<br></div><br>";
            $row_num++;
        }
        
        echo $rows;
        exit();
    }

    if (isset($_POST['i'])) {
        require_once("php_connect.php");
        
        $id = $_POST['i'];
        
        $sql = "SELECT image FROM images WHERE data_id=$id";
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));
        
        $image_tags = "";
        while ($data = mysqli_fetch_assoc($query)) {
            $image = base64_encode($data['image']);
            $image_tags .= "<img src='data:image/jpeg;base64,$image'/>";
        }
        
        echo $image_tags;
        exit();
    }
?>