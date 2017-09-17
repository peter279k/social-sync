<?php
/*
* This PHP program is to post the feed via Facebook graph API.
*/

$response = $fb->post('/me/feed', [
    'message' => 'Fooooo message is from PHP Graph SDKv5',
]);
