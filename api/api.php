<?php

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/qarson/config/constants.php");

require_once(APP_CONFIG . "database.php");

$db = new Database();


