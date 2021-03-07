<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Basic hello route
$app->get('/hello/{name}', function (Request $request, Response $response, array $arg) {
    $name = $arg['name'];
    $response->getBody()->write("Hello $name");
    return $response;
});
