<?php
include 'inc/autoloader.inc.php';

$object = new Link2();

$result = $object->linkyProj($_REQUEST['q'], $_REQUEST['id']);

echo $result['companyID'];
?>