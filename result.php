<?php

    session_start();
    require 'lib/curl-graphql.php';

    $token = $_SESSION['token'];
    if($token == "") {
        header("Location: http://caleb.techhounds.com/forks/auth.php");
        exit();
    }

    $vars = json_encode(array("owner"=>$_GET['owner'], "name"=>$_GET['name']));
    $json = build_curl(file_get_contents("query.js"), $vars);
    $forks = json_decode(get_curl($token, $json));
    $sorted_forks = array();

    echo "<pre>";
    
    foreach($forks->errors as $error) {
        echo $error->message;
    }
    
    foreach($forks->data->repository->forks->edges as $fork) {
        $sorted_forks[$fork->node->nameWithOwner] = $fork->node->watchers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->stargazers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->mentionableUsers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->issues->totalCount;
    }
    
    arsort($sorted_forks);
    
    foreach($sorted_forks as $fork=>$points) {
        echo $fork."\t".$points."\n";
    }
    
    echo "</pre>";
?>
