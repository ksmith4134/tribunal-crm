<?php
include 'inc/autoloader.inc.php';

$object = new Link2();

$object->unlinkyLeadProj($_REQUEST['id']);

$result = $object->linkyLead($_REQUEST['q'], $_REQUEST['id']);
echo $result['companyID'];

header('Location: '.$_SERVER['PHP_SELF']);
exit();
?>