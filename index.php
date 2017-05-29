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

    $count = 0;

    foreach(range(1,get_curl($base_url)->forks_count/30) as $i) {
        foreach(get_curl($base_url . "/forks?page=" . $i) as $index => $fork) {
            echo $fork->full_name . "<br>";
            $count = $count + 1;
        }

    }

    echo $count
?>
