<?php
    $curl = curl_init("https://api.github.com/repos/mangini/gdocs2md/forks");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, "karagenit");
    $data = curl_exec($curl);
    curl_close($curl);

    $fork_arr = json_decode($data);

    //var_dump($fork_arr[0]);
    
    foreach($fork_arr as $index => $fork) {
        echo $fork->full_name . "<br>";
    }
?>
