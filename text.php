<?php
//SEND TEXT MESSAGE
$to_cell_num = "CELL NUMBER TO SEND TEXT TO";
$sid = "PASTE_YOUR_SID_KEY_HERE";
$token = "PASTE_YOUR_TOKEN_KEY_HERE";
$text_number = "FROM_NUMBER";
require 'vendor/autoload.php';
$body = "Node Alert Message";
$client = new Twilio\Rest\Client($sid, $token);

$message = $client->messages->create($to_cell_num, // Text this number
  array(
    'from' => $text_number, // From a valid Twilio number
    'body' => $text_body));
?>