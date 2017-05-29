<?php

    function get_curl($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "karagenit");
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    $base_url = "https://api.github.com/repos/mangini/gdocs2md";

    $fork_arr = get_curl($base_url . "/forks");

    //fork count
    echo get_curl($base_url)->forks_count . "<br>";
    
    foreach($fork_arr as $index => $fork) {
        echo $fork->full_name . "<br>";
    }
?>
