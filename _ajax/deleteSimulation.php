<?
require("./index.php");

if (!$_user->logged)
    exit;

$simDel = $core->loadClass('simulation')->getFromId($_REQUEST['id']);
if ($simDel->delete()) {
	echo json_encode("y");
} else {
	echo json_encode("n");
}        

