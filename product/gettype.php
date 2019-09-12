<?php 
/* reads key with $_REQUEST["key"] then finds type and type description */
/* in foreach loop returns every type embeded in input field */
/* after foreach loop description is added and returned */
/* THIS FILE WOULD BE IN /php folder but im not savvy enough with .htaccess */
if (!isset($_REQUEST["key"])){

} else {
    /* have to include type.php here */
    include "../php/type.php";
    $key = $_REQUEST["key"];
    $type = new Type();
    $result = "<div class='col-md-8'>";

    foreach ($type->getType($key) as $k => $v) {
        $result .="<input type='text' class='form-control' name='$v' placeholder='$v'><br>
        ";
    }
    $result .= "</div>";
    $result .="<div class='col-md-4 float-right'>".$type->getDescription($key)."</div>";
    echo $result;
}

?>