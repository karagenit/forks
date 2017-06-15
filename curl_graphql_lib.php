<?php
    function get_curl($token, $json) {
        $curl = curl_init("https://api.github.com/graphql");
        $args = array("Content-Type: application/json", "Content-Length: ".strlen($json), "Authorization: bearer $token");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $args);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "RandomAgent");
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
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
            $json = $json.',"variables":'.$vars;
        }

        $json = $json."\n}";    
        return $json;
    }
?>
