<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Basic hello route
$app->get('/hello', function (Request $request, Response $response, array $arg) {
    $directory = $this->get('settings')['upload_directory'];
    $response->getBody()->write($directory);
    return $response;
});
