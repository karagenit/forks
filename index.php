<?php

    function get_curl($json) {
        $curl = curl_init("https://api.github.com/graphql");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: ".strlen($json), "Authorization: bearer ".file_get_contents("oauth.token")));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "RandomAgent");
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    function str_prep($str) {
        $str = str_replace("\n","",$str);   
        $str = str_replace("\"","\\\"",$str);
        return $str;
    }   

    function build_curl($query, $vars="") {
        $query = str_prep($query);
        $vars = str_replace("\n","",$vars); //gen-u-ine cancer, DONT ESCAPE THE QUOTES

        $json = "{\n";
        $json = $json.'"query":"'.$query.'"';

        if(strlen($vars) != 0) {
            $json = $json.',"variables":{'.$vars.'}';
        }

        $json = $json."\n}";    
        return $json;
    }

    $json = build_curl(file_get_contents("query.js"), file_get_contents("variables.js"));
    $forks = get_curl($json);
    $sorted_forks = array();

    echo "<pre>";
    //echo $json."\n";
    //echo var_dump(get_curl($json));
    foreach($forks->data->repository->forks->edges as $fork) {
        $sorted_forks[$fork->node->nameWithOwner] = $fork->node->watchers->totalCount;
    }
    arsort($sorted_forks);
    foreach($sorted_forks as $fork=>$watchers) {
        echo $fork."\t".$watchers."\n";
    }
    echo "</pre>";
?>
