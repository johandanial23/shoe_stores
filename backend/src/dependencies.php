<?php
//DIC configuration
$container  = $app->getContainer();

// PDO database library
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $PDO_STR = 'mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'];
    // $PDO_STR = 'mysql:host=localhost;dbname=inventory_db';
    $pdo = new PDO($PDO_STR , $settings['user'], $settings['pass']);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
