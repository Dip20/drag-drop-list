<?php

/**
 * base_url of your project
 */

if (!defined("BASE_URL")) {
    define("BASE_URL", "http://localhost/Test/drag/");
}

/**
 * This is a usefull method help to handel absolute url
 */
if (!function_exists('base_url')) {
    function base_url($path = '')
    {
        return BASE_URL . $path;
    }
}

/**
 * database config
 */


if (!defined("HOST")) {
    define("HOST", "localhost");
}


if (!defined("USERNAME")) {
    define("USERNAME", "root");
}


if (!defined("PASSWORD")) {
    define("PASSWORD", "");
}

if (!defined("DATABASE")) {
    define("DATABASE", "drag");
}
