<?php

$client_id = "YOUR_CLIENT_ID";
$client_secret = "YOUR_CLIENT_SECRET";

$request_body = array("client_id" => "YOUR_CLIENT_ID",
                      "client_secret" => "YOUR_CLIENT_SECRET",
                      "grant_type" => "client_credentials");

$request_body = json_encode($data);

$ch = curl_init('https://api.floxchange.com/api/v1/login.json');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($request_body))
);

$result = curl_exec($ch);

print_r($result);

?>
