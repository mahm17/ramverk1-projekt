<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "Forum page",
            "mount" => "forum",
            "handler" => "\Anax\Forum\ForumController",
        ],
    ]
];
