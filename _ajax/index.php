<?
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("../_/config.php");
require("../_/core/core.class.php");

$_config['path'] = "../";

$core = new core;
$core->start(false);