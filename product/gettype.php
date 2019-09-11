<?php 

/* reads key with $_REQUEST["key"] then finds type and type description */
/* in foreach loop returns every type embeded in input field */
/* after foreach loop description is added and returned */
if (!isset($_REQUEST["key"])){
    //echo "yeeeeeeeeeeeet";
} else {
    /* have to include type.php here */
    include "../php/type.php";
    $key = $_REQUEST["key"];
    $type = new Type();
    $result = "<br>";

    foreach ($type->getType($key) as $k => $v) {
        $result .="<input type='text' name='$v' placeholder='$v'><br>
        ";
    }
    $result .= " ".$type->getDescription($key);
    //echo var_dump($type->getType($key));
    echo $result;
}
?>