<?php

use Slim\Http\Request;
use Slim\Http\Response;

// include product controller file
include __DIR__ . '/../Controllers/orderController.php';

// read table carts
$app->get('/orders', function (Request $request, Response $response, array $arg) {
    $data = getOrders($this->db);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson($data, 200);
});

// Code to apply method POST
$app->post('/order/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = addOrder($this->db, $form_data);

    return $this->response->withJson(array('add data' => 'success'), 201);
});


//Code to apply method DELETE
$app->delete(
    '/order/del/[{id}]',
    function ($request, $response, $args) {
        $productId = $args['id'];
        if (!is_numeric($productId)) {
            return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
        }
        $data = delOrder($this->db, $productId);
        if (empty($data)) {
            return $this->response->withJson(array('delete' => 'success'), 200);
        }
        return $this->response->withJson(array('delete' => 'fail'), 404);
    }
);
