<?php
/*
* This is the program to receive
*/

require_once __DIR__.'/src/autoloader.php';

use peter\social\PostFeed;

header("Content-type: text/plain");

$from = '';
$apiKey = parse_ini_file(__DIR__.'/api-key.ini')['api_key'];
$event = null;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $timeStamp = isset($_POST['timestamp']) ? $_POST['timestamp']:'0';
    $token = isset($_POST['token']) ? $_POST['token']:'0';
    $signature = isset($_POST['signature']) ? $_POST['signature']:'0';
    $isValid = hash_hmac('sha256', $timeStamp.$token, $apiKey) === $_POST['signature'];
    if($timeStamp == '0' && $token == '0' && $signature == '0' && !$isValid) {
        echo 'The POST request is incorrect...';
        exit;
    }
    $event = isset($_POST['event']) ? $_POST['event']:'no-event';
} else {
    echo 'We do not accept this request method!';
    exit;
}

if($event != 'delivered') {
    echo 'We cannot identify this events!'.$event;
    exit;
}
var_dump($_POST['message-headers']);

// receive and validate the email source(CloudMailin)

/*
// parse the api-key.ini file to get the socail website credentials.
$apiKey = parse_ini_file('./api-key.ini', true);

// sync and post feed to Twitter, Facebook and Plurk.
$feed = new PostFeed();
$feed->setMessage($message);
$feed->setMessage($link);

// Facebook
$serviceName = 'Facebook';
$fbSettings = $apiKey[$serviceName];
$feed->setServiceName($serviceName);
$feed->setSettings($fbSettings);
$feed->postFeed();
$httpCode = $feed->getHttpStatusCode();
$responseMsg = $feed->getResponseMessage();

// Twitter
$serviceName = 'Twitter';
$twitterSettings = $apiKey[$serviceName];
$feed->setServiceName($serviceName);
$feed->setSettings($twitterSettings);
$feed->postFeed();
$httpCode = $feed->getHttpStatusCode();
$responseMsg = $feed->getResponseMessage();

// Plurk
$serviceName = 'Plurk';
$plurkSettings = $apiKey[$serviceName];
$feed->setServiceName($serviceName);
$feed->setSettings($plurkSettings);
$feed->postFeed();
$httpCode = $feed->getHttpStatusCode();
$responseMsg = $feed->getResponseMessage();
*/
