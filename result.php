<?php

    require 'curl_graphql_lib.php';

    $vars = json_encode(array("owner"=>$_POST['owner'], "name"=>$_POST['name']));
    $json = build_curl(file_get_contents("query.js"), $vars);
    $forks = json_decode(get_curl($json));
    $sorted_forks = array();

    echo "<pre>";
    //echo $json."\n";
    //echo var_dump(get_curl($json));
    //echo var_dump($_POST);
    foreach($forks->data->repository->forks->edges as $fork) {
        $sorted_forks[$fork->node->nameWithOwner] = $fork->node->watchers->totalCount;
    }
    arsort($sorted_forks);
    foreach($sorted_forks as $fork=>$watchers) {
        echo $fork."\t".$watchers."\n";
    }
    echo "</pre>";
?>
