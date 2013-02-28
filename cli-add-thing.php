<?php

include __DIR__ . "/config.php";
include __DIR__ . "/lib/OAuth2Client.php";
include __DIR__ . "/lib/thinkery-api-client.php";

if (!isset($_SERVER["argv"])) {
	echo "This is a command-line tool.\n";
	exit(1);
}

$command = array_shift($_SERVER["argv"]);
if (empty($_SERVER["argv"])) {
	echo "Usage: $command <thing-title>\n";
	exit(1);
}

$api = new ThinkeryApi(THINKERY_API_CLIENT_ID, THINKERY_API_CLIENT_SECRET);
$api->setVariable("username", "change-me");
$api->setVariable("password", "change-me");

$thing = array(
	"title" => implode(" ", $_SERVER["argv"]),
);
$api->api("thing/add", "POST", $thing);
