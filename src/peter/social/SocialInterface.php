<?php
/*
* The interface provides the methods to be implemented.
* public function postFeed()
* public function setMessage()
* public function getHttpStatusCode()
*/
namespace peter\social;

interface SocialInterface {
    public function iniCurl();
    public function setCurlResource($ch);
    public function getCurlResource();
    public function closeCurl();
    public function postFeed(PostFeed $feed);
}
