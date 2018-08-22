<?php
 
$config = array(
    "urls" => array(
        "baseUrl" => ""
    ),
    "paths" => array(
        "resources" => "/path/to/resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
);

defined("BASE_URL")
    or define("BASE_URL", "");

defined("DIR_PATH")
    or define("DIR_PATH", realpath(dirname(__FILE__)) . "/");

defined("INCLUDE_PAGES_PATH")
    or define("INCLUDE_PAGES_PATH", DIR_PATH . 'pages/');

// Absolute URL:        BASE_URL . HOME_PATH . xxx
// Absolute Path:       DIR_PATH . HOME_PATH
require_once(DIR_PATH . "interface.php");
/* Error reporting */
error_reporting(0);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
 
date_default_timezone_set('UTC');
?>
