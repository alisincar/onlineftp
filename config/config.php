<?php

/**
 * Created by PhpStorm.
 * User: w8
 * Date: 28.2.2019
 * Time: 20:38
 */

return [

    "paths" => [
        "config" => PATH . "config/",
        "src" => PATH . "src/"
    ],
    "DONT_REMOVES" => [
        "mozared",
        "phpMyAdmin",
        "onlineFtp"
    ],
    "FTP" => [
        "host" => "yoursite.com",
        "port" => "22",
        "username" => "user",
        "password" => "secret",
        "path" => "/",
        "tls" => false
    ]
];
