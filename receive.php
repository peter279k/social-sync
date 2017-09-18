<?php
/*
* This is the program to receive the mailing contents from CloudMailin(https://www.cloudmailin.com)
*/

require_once __DIR__.'/src/autoloader.php';

use peter\social\PostFeed;

header("Content-type: text/plain");

var_dump($_POST);

echo 'it is successfully received by'.$fromEmailAddress.'!';
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
