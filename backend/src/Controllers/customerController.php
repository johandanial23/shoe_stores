<?php

//get all product 

use Slim\Http\Request;
use Slim\Http\Response;

// get all customers
function getCustomers($db)
{
    // $sql = 'Select p.name, p.description, p.price, c.name as category from products p ';
    // $sql .= 'INNER JOIN categories c on p.category_id = c.id ';
    $sql = 'SELECT * from customers';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get product by id
function getProduct($db, $productId)
{
    $sql = 'SELECT p.name, p.description, p.price, c.name as category from products p ';
    $sql .= 'INNER JOIN categories c on p.category_id = c.id ';
    $sql .= 'WHERE p.id =:id';
    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// add new product
function createProduct($db, $form_data)
{
    $sql = 'Insert into products (name, description, price, category_id, created) ';
    $sql .= 'values (:name, :description, :price, :category_id, :created)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':category_id', $form_data['category_id']);
    $stmt->bindParam(':created', $form_data['created']);
    $stmt->execute();
    return $db->lastInsertID();
}

// Update existing record - insert ID by URL
function updateProduct($db, $productId, $form_data)
{
    $sql = "UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created WHERE id=:id";

    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':category_id', $form_data['category_id']);
    $stmt->bindParam(':created', $form_data['created']);
    $stmt->execute();
    return $stmt->rowCount();
}

// Delete existing record
function deleteProduct($db, $productId)
{
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}



// Search product by (price)
function searchProductbyPrice($db, $productPrice)
{
    $sql = 'SELECT p.name, p.description, p.price, c.name as category from products p ';
    $sql .= 'INNER JOIN categories c on p.category_id = c.id ';
    $sql .= 'WHERE p.price =:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Update product by condition (price)
function updateProductbyPrice($db, $productPrice, $form_data)
{
    $sql = "UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created WHERE price=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':category_id', $form_data['category_id']);
    $stmt->bindParam(':created', $form_data['created']);
    $stmt->execute();
    return $stmt->rowCount();
}

// Delete product by condition (price)
function deleteProductbyPrice($db, $productPrice)
{
    $sql = 'DELETE FROM products WHERE price = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $productPrice, PDO::PARAM_INT);
    $stmt->execute();
}