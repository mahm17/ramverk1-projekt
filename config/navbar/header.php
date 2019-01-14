<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "home",
            "title" => "Home",
        ],
        [
            "text" => "Forum",
            "url" => "forum",
            "title" => "Forum",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "All tags",
        ],
        [
            "text" => "Register",
            "url" => "login/create",
            "title" => "Register",
        ],
        [
            "text" => "Login",
            "url" => "login",
            "title" => "Login",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this webpage",
        ],
        [
            "text" => "Profile",
            "url" => "profile",
            "title" => "Your profile",
        ],
        [
            "text" => "All users",
            "url" => "profile/all",
            "title" => "All users",
        ]
    ],
];
