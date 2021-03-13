<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'upload_directory' => 'D:\XAMPP\htdocs\shoe_stores\frontend\img',

        //Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Database connection settings
        "db" => [
            "host" => "localhost",
            "dbname" => "shoe_stores",
            "user" => "root",
            "pass" => "",
        ]
    ],
];
