<?php
/*
* This is the program to receive
*/

require_once __DIR__.'/src/autoloader.php';

use peter\social\PostFeed;

header("Content-type: text/plain");

$mailGun = parse_ini_file(__DIR__.'/api-key.ini');
$apiKey = $mailGun['api_key'];
$sender = $mailGun['sender'];
$from = $mailGun['sandbox_address'];
$event = null;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSender = (isset($_POST['sender']) ? $_POST['sender']:'') === $sender;
    $isFrom = (isset($_POST['recipient']) ? $_POST['recipient']:'') === $from;
    if(!$isSender && !$isFrom) {
        echo 'The sender and from address is invalid!';
        exit;
    }
} else {
    echo 'We do not accept this request method!';
    exit;
}

$bodyHtml = isset($_POST['body-html']) ? $_POST['body-html']:'';
$bodyPlain = isset($_POST['body-plain']) ? $_POST['body-plain']:'';

echo 'message body: '.$bodyHtml.PHP_EOL.$bodyPlain;

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
