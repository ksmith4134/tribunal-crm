<?php
include 'inc/autoloader.inc.php';

$object = new Link2();

$checkboxCurrent = $_REQUEST['checkbox'];
$id = $_REQUEST['id'];

if($checkboxCurrent == 0){
    $checkboxNew = 1;
    $object->deletePreFUPToDos();
} else {
    $checkboxNew = 0;
}


$result = $object->checkboxOptOut($checkboxNew, $id);

echo $result['opt_out'];

header('Location: '.$_SERVER['PHP_SELF']);
exit();
?>