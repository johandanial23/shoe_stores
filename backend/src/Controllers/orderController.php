<?php

//get all product 

use Slim\Http\Request;
use Slim\Http\Response;

function getOrders($db)
{
    $sql = "SELECT orders.id, products.name as productName, orders.quantity, customers.name, customers.address, customers.phone FROM orders INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON products.id=orders.product_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// add new product
function addOrder($db, $form_data)
{
    $customer_id = createCustomer($db, $form_data);
    $orders = getOrderFromCart($db);

    foreach ($orders as $order) {

        $sql = 'Insert into `orders` (product_id, customer_id, quantity) ';
        $sql .= 'values (:product_id, :customer_id, :quantity)';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':product_id', $order['product_id'], PDO::PARAM_INT);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $order['quantity'], PDO::PARAM_INT);
        $stmt->execute();
    }

    deleteItemsInCart($db);

    return true;
}

// create new customer
function createCustomer($db, $form_data)
{
    $sql = 'Insert into customers (name, address, phone) ';
    $sql .= 'values (:name, :address, :phone)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':address', $form_data['address']);
    $stmt->bindParam(':phone', $form_data['phone']);
    $stmt->execute();
    return $db->lastInsertID();
}

// Get order id from cart
function getOrderFromCart($db)
{
    $sql = "SELECT * FROM carts";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function deleteItemsInCart($db)
{
    $sql = 'DELETE FROM carts';
    $stmt = $db->prepare($sql);
    $stmt->execute();
}


// Delete existing record
function delOrder($db, $productId)
{
    $sql = 'DELETE FROM orders WHERE id = :id';
    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
