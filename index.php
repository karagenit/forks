<?php
    $curl = curl_init("https://api.github.com/repos/mangini/gdocs2md/forks");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);
    echo $data;
?>
