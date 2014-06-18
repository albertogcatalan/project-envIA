<?

ini_set('display_errors', 0);
error_reporting(E_ERROR);

require("./_/config.php");
require("./_/core/core.class.php");


		
$core = new core;
//$core->enableDebug();
$core->start();
//$core->showLog();
//$core->conn->showDebug(1,1);
exit;
