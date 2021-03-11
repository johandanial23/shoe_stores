<?php

//get all product 

use Slim\Http\Request;
use Slim\Http\Response;

function getCarts($db)
{
    $sql = "SELECT carts.id, products.name, products.price, carts.quantity, products.image FROM carts INNER JOIN products on carts.product_id = products.id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// //Get product by id
// function getProduct($db, $productId)
// {
//     // $sql = 'SELECT p.name, p.description, p.price, c.name as category from products p ';
//     // $sql .= 'INNER JOIN categories c on p.category_id = c.id ';
//     // $sql .= 'WHERE p.id =:id';
//     $sql = "SELECT * from products where id=:id";
//     $stmt = $db->prepare($sql);
//     $id = (int) $productId;
//     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }


// add new product
function addtoCart($db, $form_data)
{
    $sql = 'Insert into carts (product_id, quantity) ';
    $sql .= 'values (:product_id, :quantity)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':product_id', $form_data['product_id']);
    $stmt->bindParam(':quantity', $form_data['quantity']);
    $stmt->execute();
    return $db->lastInsertID();
}

// // Update existing record - insert ID by URL
// function updateProduct($db, $productId, $form_data)
// {
//     $sql = "UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created WHERE id=:id";

//     $stmt = $db->prepare($sql);
//     $id = (int) $productId;
//     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//     $stmt->bindParam(':name', $form_data['name']);
//     $stmt->bindParam(':description', $form_data['description']);
//     $stmt->bindParam(':price', $form_data['price']);
//     $stmt->bindParam(':category_id', $form_data['category_id']);
//     $stmt->bindParam(':created', $form_data['created']);
//     $stmt->execute();
//     return $stmt->rowCount();
// }

// Delete existing record
function delCart($db, $productId)
{
    $sql = 'DELETE FROM carts WHERE id = :id';
    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Delete existing record
function delallCart($db)
{
    $sql = 'DELETE FROM carts';
    $stmt = $db->prepare($sql);
    $stmt->execute();
}


// // Search product by (price)
// function searchProductbyPrice($db, $productPrice)
// {
//     $sql = 'SELECT p.name, p.description, p.price, c.name as category from products p ';
//     $sql .= 'INNER JOIN categories c on p.category_id = c.id ';
//     $sql .= 'WHERE p.price =:id';
//     $stmt = $db->prepare($sql);
//     $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// // Update product by condition (price)
// function updateProductbyPrice($db, $productPrice, $form_data)
// {
//     $sql = "UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created WHERE price=:id";

//     $stmt = $db->prepare($sql);
//     $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
//     $stmt->bindParam(':name', $form_data['name']);
//     $stmt->bindParam(':description', $form_data['description']);
//     $stmt->bindParam(':price', $form_data['price']);
//     $stmt->bindParam(':category_id', $form_data['category_id']);
//     $stmt->bindParam(':created', $form_data['created']);
//     $stmt->execute();
//     return $stmt->rowCount();
// }

// // Delete product by condition (price)
// function deleteProductbyPrice($db, $productPrice)
// {
//     $sql = 'DELETE FROM products WHERE price = :id';
//     $stmt = $db->prepare($sql);
//     $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
//     $stmt->execute();
// }