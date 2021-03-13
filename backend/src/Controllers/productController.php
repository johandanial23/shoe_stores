<?php

//get all product 

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\UploadedFileInterface;

function getAllProducts($db)
{
    $sql = 'Select * from products';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSaleProduct($db)
{
    $sql = "SELECT * FROM products limit 4";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



//Get product by id
function getProduct($db, $productId)
{
    $sql = "SELECT * from products where id=:id";
    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// add new product
function createProduct($db, $form_data, $directory, $request)
{
    $filename = upload($request, $directory);

    $sql = 'Insert into products (name, price, image) ';
    $sql .= 'values (:name, :price, :image)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':image', $filename);
    $stmt->execute();
    return $db->lastInsertID();
}

function upload($request, $directory)
{
    $uploadedFiles = $request->getUploadedFiles();

    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['image'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = moveUploadedFile($directory, $uploadedFile);
    }

    return $filename;
}

function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

// Update existing record - insert ID by URL
function updateProduct($db, $productId, $request, $directory)
{
    $form_data = $request->getParsedBody();
    $sql = "UPDATE products SET name=:name, price=:price WHERE id=:id";

    $stmt = $db->prepare($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':price', $form_data['price']);
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