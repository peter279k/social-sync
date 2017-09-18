<?php
/*
* The interface provides the methods to be implemented.
* public function postFeed()
* public function setMessage()
* public function getHttpStatusCode()
*/
namespace peter\social;

interface SocialInterface {
    public function postFeed(PostFeed $feed);
}
