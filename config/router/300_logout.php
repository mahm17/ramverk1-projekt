<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "Logout page",
            "mount" => "login/logout",
            "handler" => "\Anax\User\UserController",
        ],
    ]
];
