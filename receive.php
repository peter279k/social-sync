<?php
/*
* This is the program to receive the mailing contents from CloudMailin(https://www.cloudmailin.com)
*/

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/autoloader.php';

use peter\social\PostFeed;

$message = '';
$email = __DIR__.'/api-key.ini';
$toEmailAddress = parse_ini_file($email)['to_email_address'];
$fromEmailAddress = parse_ini_file($email)['from_email_address'];
$from = isset($_POST['envelope']['from']) ? $_POST['envelope']['from']:'no-from-address';
$to = isset($_POST['envelope']['to']) ? $_POST['envelope']['to']:'no-to-address';
$subject = isset($_POST['headers']['Subject']) ? $_POST['headers']['Subject']:'no-subject';
$plain = isset($_POST['plain']) ? $_POST['plain']:'no-plain-text';
$html = isset($_POST['html']) ? $_POST['html']:'no-html-string';
$reply = isset($_POST['reply_plain']) ? $_POST['reply_plain']:'no-reply-plain';

if($to !== $toEmailAddress) {
    echo 'the to email address is not allowed here';
    exit;
}
if($from !== $fromEmailAddress) {
    echo 'the from email address is not allowed here';
    exit;
}

echo 'it is successfully received by'.$fromEmailAddress.'!';
file_put_contents('/home/peter/log.txt', $plain);
file_put_contents('/home/peter/log.txt', $html, FILE_APPEND);
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
