<?php
    $curl = curl_init("https://api.github.com/repos/mangini/gdocs2md/forks");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, "karagenit");
    $data = curl_exec($curl);
    curl_close($curl);

    $arr = json_decode($data);

    //var_dump($arr[0]);

    echo $arr[0]->id;
?>
