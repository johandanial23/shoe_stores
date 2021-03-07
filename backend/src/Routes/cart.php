<?php

use Slim\Http\Request;
use Slim\Http\Response;

// include product controller file
include __DIR__ . '/../Controllers/cartController.php';

// read table products
$app->get('/carts/[{id}]', function (Request $request, Response $response, array $arg) {
    $data = getCarts($this->db);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson(array('data' => $data), 200);
});

// // request table prdouct by condition
// $app->get('/product/[{id}]', function ($request, $response, $args) {
//     $productId = $args['id'];
//     if (!is_numeric($productId)) {
//         return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//     }
//     $data = getProduct($this->db, $productId);
//     if (empty($data)) {
//         return $this->response->withJson(array('error' => 'no data'), 404);
//     }
//     return $this->response->withJson(array('data' => $data), 200);
// });


// // Code to apply method POST
// $app->post('/product/add', function ($request, $response, $args) {
//     $form_data = $request->getParsedBody();
//     $data = createProduct($this->db, $form_data);

//     if ($data <= 0) {
//         return $this->response->withJson(array('error' => 'add data fail'), 500);
//     }
//     return $this->response->withJson(array('add data' => 'success'), 201);
// });

// //Code to apply method PUT
// $app->put(
//     '/product/update/[{id}]',
//     function ($request, $response, $args) {
//         $productId = $args['id'];
//         if (!is_numeric($productId)) {
//             return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//         }
//         $form_data = $request->getParsedBody();
//         $data = updateProduct($this->db, $productId, $form_data);
//         if ($data <= 0) {
//             return $this->response->withJson(array('error' => 'update data fail'), 500);
//         }
//         return $this->response->withJson(array('update data' => 'success'), 201);
//     }
// );

// //Code to apply method DELETE
// $app->delete(
//     '/product/del/[{id}]',
//     function ($request, $response, $args) {
//         $productId = $args['id'];
//         $data = deleteProduct($this->db, $productId);
//         if (!is_numeric($productId)) {
//             return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//         }
//         $data = deleteProduct($this->db, $productId);
//         if (empty($data)) {
//             return $this->response->withJson(array('delete' => 'success'), 200);
//         }
//         return $this->response->withJson(array('delete' => 'fail'), 404);
//     }
// );

// // Search product by condition (by price)
// $app->get('/product/price/[{price}]', function ($request, $response, $args) {
//     $productPrice = $args['price'];
//     if (!is_numeric($productPrice)) {
//         return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//     }
//     $data = searchProductbyPrice($this->db, $productPrice);
//     if (empty($data)) {
//         return $this->response->withJson(array('error' => 'no data'), 404);
//     }
//     return $this->response->withJson(array('data' => $data), 200);
// });

// //Edit product by condition (price)
// $app->put(
//     '/product/edit/[{price}]',
//     function ($request, $response, $args) {
//         $productPrice = $args['price'];
//         if (!is_numeric($productPrice)) {
//             return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//         }
//         $form_data = $request->getParsedBody();
//         $data = updateProductbyPrice($this->db, $productPrice, $form_data);
//         if ($data <= 0) {
//             return $this->response->withJson(array('error' => 'update data fail'), 500);
//         }
//         return $this->response->withJson(array('update data' => 'success'), 201);
//     }
// );

// //Delete product by condition (price)
// $app->delete(
//     '/product/delete/[{price}]',
//     function ($request, $response, $args) {
//         $productPrice = $args['price'];
//         // $data = deleteProductbyPrice($this->db, $productPrice);
//         if (!is_numeric($productPrice)) {
//             return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
//         }
//         $data = deleteProductbyPrice($this->db, $productPrice);
//         if (empty($data)) {
//             return $this->response->withJson(array('delete' => 'success'), 200);
//         }
//         return $this->response->withJson(array('delete' => 'fail'), 404);
//     }
// );