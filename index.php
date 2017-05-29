<?php
    $curl = curl_init("https://api.github.com/repos/mangini/gdocs2md/forks");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, "karagenit");
    //curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    $data = curl_exec($curl);
    //$info = curl_getinfo($curl);
    curl_close($curl);
    echo $data;
?>
