<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "Tags page",
            "mount" => "tags",
            "handler" => "\Anax\Tags\TagsController",
        ],
    ]
];
