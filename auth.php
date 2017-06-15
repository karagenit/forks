<?php
    $client_id = file_get_contents("client_id.token");
    $client_secret = file_get_contents("client_secret.token");
    $code = $_GET['code'];
    $args = array("client_id"=>$client_id, "client_secret"=>$client_secret, "code"=>$code);

    $curl = curl_init("https://github.com/login/oauth/access_token");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    var_dump(curl_exec($curl));
?>
