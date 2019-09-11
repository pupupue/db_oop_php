<?php
/* HERE YOU CAN FORMAT AND ECHO OUT ELEMENTS AS YOU WISH */
/* DEFAULT CASE IS IN PRODUCT showItem($set) */
// from array $set[postition][what element you want]
class Furniture extends Product
{
    public function showItem($set)
    {
        //all showItem() functions work the same
        echo '<h5><b>Dimension</b>: '.$set[0]['attribute_value']."x".$set[1]['attribute_value']."x".$set[2]['attribute_value']."</h5><br>";
        // $set[0]..[1]..[2] is HxWxL
        echo '<h5><b>'.$set[3]['attribute_name'].'</b>: '.$set[3]['attribute_value']."kg</h5><br>";
    }
}

class Disk extends Product
{
    public function showItem($set)
    {       
        echo '<h5><b>'.$set[0]['attribute_name'].'</b>: '.$set[0]['attribute_value']."GB</h5><br>";
    }
}

class Material extends Product
{
    public function showItem($set)
    {
        echo '<h5><b>'.$set[0]['attribute_name'].'</b>: '.$set[0]['attribute_value']."Kg</h5><br>";
    }
}

class Book extends Product
{

    public function showItem($set)
    {
        echo '<h5><b>by</b> '.$set[0]['attribute_value']." (".$set[0]['attribute_name'].")</h5><br>";
        echo '<h5><b>'.$set[1]['attribute_name'].'</b>: '.$set[1]['attribute_value']."</h5><br>";
    }
} 
