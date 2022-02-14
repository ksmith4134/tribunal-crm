<?php
include 'inc/autoloader.inc.php';

$object = new Link2();

$result = $object->linkyLeadProj($_REQUEST['u'], $_REQUEST['id']);

echo $result['projectID'];

header('Location: '.$_SERVER['PHP_SELF']);
exit();
?>