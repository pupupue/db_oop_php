<?php 
include_once "init.php";
/* reads key with $_REQUEST["key"] then finds item type and its coresponding description from object*/

if (!isset($_REQUEST["key"])){

} else {
    $key = $_REQUEST["key"];
    $type = new $key();
    $result = $type->getObjectTypes();
    echo $result;
}

?>