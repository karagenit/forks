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

    $recursion = intval($_SESSION['recursion']);
    $forks = intval($_SESSION['forks']);
    $threshold = intval($_SESSION['threshold']);
    $token = $_SESSION['token'];

    if($token == NULL) {
        header("Location: http://caleb.techhounds.com/forks/auth.php");
        exit();
    }
?>
