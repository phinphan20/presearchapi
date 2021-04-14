<?php
//THIS CODE WORKS WITH MAILJET
require 'vendor/autoload.php';
use \Mailjet\Resources;
$mj = new \Mailjet\Client('PASTE_YOUR_API_KEY_HERE','PASTE_YOUR_API_KEY_HERE',true,['version' => 'v3.1']);
$body = [
	'Messages' => [
		[
			'From' => [
				'Email' => "from@email.com", 
				'Name' => "From Name"
			],
			'To' => [
				[
					'Email' => "to@email.com",
					'Name' => "To Name"
				]
			],
			'Subject' => $email_subject,
			'TextPart' => "node alerts",
			'HTMLPart' => $email_body,
		 ]
	],
	 ];
$response = $mj->post(Resources::$Email, ['body' => $body]);
//$response->success() && var_dump($response->getData());