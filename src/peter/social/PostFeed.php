<?php
/*
* This is the PHP progoram to dispatch the social websites and post the feeds.
*/

namespace peter\social;

class PostFeed {

    private $serviceName = '';
    private $settings = [];
    private $message = '';
    private $responseMessage = '';
    private $httpCode = 200;
    private $link = '';

    public function postFeed() {
        $social = [
            'Twitter',
            'Facebook',
            'Plurk',
        ];

        if(in_array($this->serviceName, $social)) {
            $index = array_search($this->serviceName, $social);
            $className = 'peter\\social\\'.$social[$index];

            return (new $className)->postFeed($this);
        }

        throw new \RuntimeException('cannot support this social service');
    }

    public function setServiceName($name) {

        $this->serviceName = $name;
    }

    public function getServiceName() {

        return $this->serviceName;
    }

    public function setSettings($key, $value) {

        $settings[$key] = $value;
    }

    public function getSettings() {

        return $this->settings;
    }

    public function setMessage($message) {

        $this->message = $message;
    }

    public function getMessage() {

        return $this->message;
    }

    public function setHttpStatusCode($code) {

        $this->httpCode = $code;
    }

    public function getHttpStatusCode() {

        return $this->httpCode;
    }

    public function setResponseMessage($resMsg) {

        $this->responseMessage = $resMsg;
    }

    public function getResponseMessage() {

        return $this->responseMessage;
    }

    public function setLink($link) {

        $this->link = $link;
    }

    public function getLink() {

        return $this->link;
    }
}
