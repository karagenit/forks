<?php
    session_start();

    if($_SESSION['recursion'] == NULL) {
        $_SESSION['recursion'] = 0;
    }

    if($_SESSION['forks'] == NULL) {
        $_SESSION['forks'] = 20;
    }

    if($_SESSION['threshold'] == NULL) {
        $_SESSION['threshold'] = 3;
    }

    $recursion = $_SESSION['recursion'];
    $forks = $_SESSION['forks'];
    $threshold = $_SESSION['threshold'];
    $token = $_SESSION['token'];

    if($token == NULL) {
        header("Location: http://caleb.techhounds.com/forks/auth.php");
        exit();
    }
?>
