<?php

    function get_curl($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "karagenit");
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    $fork_arr = get_curl("https://api.github.com/repos/mangini/gdocs2md/forks");
    
    //var_dump($fork_arr[0]);
    
    foreach($fork_arr as $index => $fork) {
        echo $fork->full_name . "<br>";
    }
?>
