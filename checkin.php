<?php
// Accept a POST request for a checkin at a Code for America event.
// Add the secret key and post it to the people-app.
// We do this because we want to give people an endpoint they can start
// sending checkins too, yet we want to be able to change
// the actual endpoint on our end.

$posted = array(
	'SECRET_KEY' => getenv('SECRET_KEY'),
	"first_name" => $_POST["first_name"],
	"last_name" => $_POST["last_name"],
	"email" => $_POST["email"],
	"event_name" => $_POST["event_name"],
	"date" => $_POST["date"],
	"cfapi_org_id" => $_POST["cfapi_org_id"]
	);

$opts = array(
	'http' => array(
		'method' => 'POST',
		'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
		'content' => http_build_query($posted),
		'timeout' => 5
		)
	);

//
// Send POST to the People app.
//
$context  = stream_context_create($opts);
$url = 'http://127.0.0.1:5000/checkin';
$response = file_get_contents($url, false, $context, -1, 40000);

?>