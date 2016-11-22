<?php
    session_start();

    if ($_SESSION['userid'] && $_POST['title']) {
        require_once('db_connect.php');

        $formOk = true;
        $title = $_POST['title'];
        $weight = $_POST['weight'];
        
        if (empty($title) || empty($weight)) {
            header("location: message.php?msg=Fill out all the fields!");
        }
        
        if ($_FILES['fileInput']['name'][0] == '') {
            $size = 0;
        } else {
            $size = count($_FILES['fileInput']['name']);
        }
        
        $sql = "INSERT INTO data (user_id, title, weight) VALUES (".$_SESSION['userid'].", '$title', $weight)";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        $sql = "SELECT max(id) FROM data";
        $query = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($query);
        $data_id = $row[0];
        
        $usedNames = [];
        $sql = "SELECT name FROM images WHERE user_id=".$_SESSION['userid'];
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                array_push($usedNames, $row['name']);
            }
        }
    
        $uploadedIds = [];
        for ($i = 0; $i < $size; $i++) {
            if (!in_array($_FILES['fileInput']['type'][$i], array('image/png', 'image/jpeg', 'image/jpe', 'image/gif', 'image/jpg'))) {
                $formOk = false;
                $msg = "Error: Unsupported file extension. Supported extensions are JPG / PNG / GIF.";
                break;
            }
            
            if ($_FILES['fileInput']['size'][$i] > 10000000) {
                $formOk = false;
                $msg = "Error: Unsupported file size. Max file size is 10MB.";
                break;
            }
            
            if (in_array($_FILES['fileInput']['name'][$i], $usedNames)) {
                $formOk = false;
                $msg = "Error: File name already exists. (".$_FILES['fileInput']['name'][$i].")";
                break;
            }
            
            $image = file_get_contents($_FILES['fileInput']['tmp_name'][$i]);
            $imageName = $_FILES['fileInput']['name'][$i];
            $image = mysqli_real_escape_string($db, $image);
            $sql = "INSERT INTO images (user_id, data_id, name, image) VALUES (".$_SESSION['userid'].", $data_id, '{$imageName}','{$image}')";
            if (mysqli_query($db, $sql)) {
                $sql = "SELECT max(id) FROM images";
                $query = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($query);
                array_push($uploadedIds, $row[0]);
            }
        }
        
        if (!$formOk) {
            $n = count($uploadedIds);
            for ($i = 0; $i < $n; $i++) {
                $sql = "DELETE FROM images WHERE id=$uploadedIds[$i]";
                mysqli_query($db, $sql) or die(mysqli_error($db));
            }
            
            $sql = "DELETE FROM data WHERE id=$data_id";
            mysqli_query($db, $sql) or die(mysqli_error($db));
            
            header("location: message.php?msg=$msg");
        }
    }
?>