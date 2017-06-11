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
    $query = file_get_contents("query.js");
    $query = str_replace("\n","",$query);   
    $query = str_replace("\"","\\\"",$query);
    $json = "{\n\"query\":\"".$query."\"\n}";

    echo "<pre>";
    echo $query."\n";
    echo $json."\n";
    echo var_dump(get_curl($json));
    echo "</pre>";
?>
