<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header("location: ../prostate-cancer.html#dashboard");
        exit();
    }
?>