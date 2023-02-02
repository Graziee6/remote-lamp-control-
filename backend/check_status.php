<?php

$input = (array) json_decode(file_get_contents('php://input'), TRUE);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://arduino_ip_address:port/status");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
echo $response;
curl_close($ch);

?>