<?php
    session_start();

    $client_id = file_get_contents("client_id.token");
    $client_secret = file_get_contents("client_secret.token");
    $code = $_GET['code'];

    if($code == "") {
        header("Location: https://github.com/login/oauth/authorize?client_id=$client_id");
        exit();
    }
    
    $args = array("client_id"=>$client_id, "client_secret"=>$client_secret, "code"=>$code);

    $curl = curl_init("https://github.com/login/oauth/access_token");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/json"));

    $curl_data = json_decode(curl_exec($curl));
    $token = $curl_data->access_token;
    if($token != NULL) { //if the user refreshes auth.php, TOKEN = NULL, but we don't want to overwrite
        $_SESSION['token'] = $token;
    }

    header("Location: http://caleb.techhounds.com/forks/query.html");
    exit();
?>
