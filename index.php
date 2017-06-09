<?php

    function get_curl($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: token ".file_get_contents("oauth.token")));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "RandomAgent");
        //curl_setopt($curl, CURLOPT_USERPWD, "user:pass"); //despite this working with bash cURL, can't just pass the token here
        //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }
   
    echo var_dump(get_curl("https://api.github.com/rate_limit"));
?>
