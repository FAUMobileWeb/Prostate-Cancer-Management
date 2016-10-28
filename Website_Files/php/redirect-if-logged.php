<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header("location: ../prostate-cancer.php#dashboard");
        exit();
    }
?>