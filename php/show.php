<?php
/* HERE YOU CAN FORMAT AND ECHO OUT ELEMENTS AS YOU WISH */
/* DEFAULT CASE IS IN PRODUCT showItem($set) */
// from array $set[postition][what element you want]
class Furniture extends Product
{
    public function showItem($set)
    {
        //all showItem() functions work the same
        echo '<b>Dimension</b>: '.$set[0]['attribute_value']." x ".$set[1]['attribute_value']." x ".$set[2]['attribute_value']."<br>";
        // $set[0]..[1]..[2] is HxWxL
        echo '<b>'.$set[3]['attribute_name'].'</b>: '.$set[3]['attribute_value']."kg<br>";
        echo '<b>'.$set[4]['attribute_name'].'</b>: '.$set[4]['attribute_value']."<br>";
        echo '<b>'.$set[5]['attribute_name'].'</b>: '.$set[5]['attribute_value']."<br>";
    }
}

class Clock extends Product
{
    public function showItem($set)
    {
        echo '<b>Dimension</b>: '.$set[0]['attribute_value']." x ".$set[1]['attribute_value']." x ".$set[2]['attribute_value']."<br>";
        echo '<b>'.$set[3]['attribute_name'].'</b>: '.$set[3]['attribute_value']."<br>";
        echo '<b>'.$set[4]['attribute_name'].'</b>: '.$set[4]['attribute_value']."kg<br>";
        echo '<b>'.$set[5]['attribute_name'].'</b>: '.$set[5]['attribute_value']."<br>";
        echo '<b>'.$set[6]['attribute_name'].'</b>: '.$set[6]['attribute_value']." clock<br>";
    }
}

class Lamp extends Product
{
    public function showItem($set)
    {
        echo '<b>Dimension</b>: '.$set[0]['attribute_value']." x ".$set[1]['attribute_value']." x ".$set[2]['attribute_value']."<br>";
        echo '<b>'.$set[3]['attribute_name'].'</b>: '.$set[3]['attribute_value']."kg<br>";
        echo '<b>'.$set[4]['attribute_name'].'</b>: '.$set[4]['attribute_value']."<br>";
        echo '<b>'.$set[5]['attribute_name'].'</b>: '.$set[5]['attribute_value']."<br>";
        echo '<b>Voltage</b>: '.$set[6]['attribute_value']."V<br>";
    }
}

class Movie extends Product
{
    public function showItem($set)
    {       
        echo '<h5><b>Available on</b>: '.$set[0]['attribute_value']."</h5><br>";
        echo '<b>'.$set[1]['attribute_name'].'</b>: '.$set[1]['attribute_value']."<br>";
        echo '<b>'.$set[2]['attribute_name'].'</b>: '.$set[2]['attribute_value']."<br>";
        echo '<b>'.$set[3]['attribute_name'].'</b>: '.$set[3]['attribute_value']."<br>";
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
        echo '<b>'.$set[1]['attribute_name'].'</b>: '.$set[1]['attribute_value']."<br>";
        echo '<b>'.$set[2]['attribute_name'].'</b>: '.$set[2]['attribute_value']."<br>";
    }
} 
