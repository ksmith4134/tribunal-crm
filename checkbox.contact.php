<?php
include 'inc/autoloader.inc.php';

$object = new Link2();

$checkboxCurrent = $_REQUEST['checkbox'];
$id = $_REQUEST['id'];

if($checkboxCurrent == 0){
    $checkboxNew = 1;
    $contact_date = date('Y-m-d');
    $object->deletePreFUPToDos();
} else {
    $checkboxNew = 0;
    $contact_date = null;
}


$result = $object->checkboxContact($checkboxNew, $contact_date, $id);

echo $result['contact_made'];

header('Location: '.$_SERVER['PHP_SELF']);
exit();
?>