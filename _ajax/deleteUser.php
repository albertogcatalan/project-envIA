<?
require("./index.php");

if (!$_user->logged)
    exit;

if (!$_user->isAdmin())
    exit;
    

$userDel = $core->loadClass('user')->getFromId($_REQUEST['id']);
if ($userDel->delete()) {
	echo json_encode("y");
} else {
	echo json_encode("n");
}        

