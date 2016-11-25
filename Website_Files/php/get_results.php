<?php
    session_start();
    require_once('php_connect.php');
        
    $user_id = $_SESSION['userid'];

    $sql = "SELECT weight, timestamp FROM data WHERE user_id=$user_id ORDER BY timestamp";
    $query = mysqli_query($db, $sql) or die(mysqli_error($db));

    $rows = [];

    while ($data = mysqli_fetch_assoc($query)) {
        $weight = $data['weight'];
        $timestamp = strtotime($data['timestamp']);
        $date = date('m-d-Y', $timestamp);

        array_push($rows, array($weight, $date));
    }

    if ($rows) {
        echo json_encode($rows);
    } else {
        echo "No data";
    }
    exit();
?>