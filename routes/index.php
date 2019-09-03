<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

$mainPage = file_get_contents('../resources/views/index.html');

$router->get('/', function() use ($mainPage) {
    return $mainPage;
});

$router->post('/push', function() {
    echo 'hello world';
});