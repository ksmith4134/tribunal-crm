<?php
include 'inc/autoloader.inc.php';

$checkboxCurrent = $_REQUEST['checkbox'];
$id = $_REQUEST['id'];

if($checkboxCurrent == 0){
    $checkboxNew = 1;
    $doneAt = date('Y-m-d');
} else {
    $checkboxNew = 0;
    $doneAt = null;
}

$object = new Link2();
$result = $object->checkbox($checkboxNew, $doneAt, $id);

echo $result['done'];

header('Location: '.$_SERVER['PHP_SELF']);
exit();
?>