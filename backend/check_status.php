<?php

$input = file_get_contents('php://input');
echo $input;

$object = json_decode($input);
$status = $object->status;
echo $status;
print_r($status);
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "http://arduino_ip_address:port/status");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $response = curl_exec($ch);
// echo $response;
// curl_close($ch);

?>