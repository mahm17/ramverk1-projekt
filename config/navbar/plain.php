<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Forum",
            "url" => "forum",
            "title" => "Forum",
        ],
        [
            "text" => "Registrera dig",
            "url" => "login/create",
            "title" => "Registrera dig",
        ],
        [
            "text" => "Logga in",
            "url" => "login",
            "title" => "Logga in",
        ]
    ],
];
