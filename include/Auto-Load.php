<?php
ob_start();

// Session Control
session_start();

// Error Management
error_reporting(0);


//DB Config

require_once(__DIR__ . '/config.php');

require_once(__DIR__ . '/database.php');

require_once(__DIR__ . '/common-class.php');

//require_once(__DIR__ . '/SMS-Class.php');
// Current Date
global $GlobalDate;
$GlobalDateTime = date("Y-m-d H:i:s");

