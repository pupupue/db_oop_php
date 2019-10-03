<?php


class Lamp extends Item
{
    protected static $db_attributes_table = "lamp";
    protected static $db_attributes_table_fields = array('color', 'material', 'volts', 'weight', 'height', 'width', 'length');
    protected static $description = 'Please provide the color,<br>as well as the Voltage (110, 120, ect),<br> Weight should be in (kg),<br> Please provide the Lamps dimensions in Height, Width, Length (HxWxL)cm format.';
    protected static $attribute_rules = array(
        'height' => array(
            'required' => true,
            'double' => true
        ),
        'width'=> array(
            'required' => true,
            'double' => true
        ),
        'length'=> array(
            'required' => true,
            'double' => true
        ),
        'weight'=> array(
            'required' => true,
            'double' => true
        ),
        'material'=> array(
            'required' => true,
            'char' => true,
            'min' => 2,
            'max' => 255
        ),
        'volts'=> array(
            'required' => true,
            'int' => true,
        ),
        'color'=> array(
            'required' => true,
            'char' => true
        )
    );

    public $height;
    public $width;
    public $length;
    public $weight;
    public $color;
    public $material;
    public $volts;


    public function showItemDetails()
    {
        echo "<b>Dimension</b>: ".$this->height." x ".$this->width." x ".$this->length."<br>";
        echo "<b>Color</b>: ".$this->color."<br>";
        echo "<b>Material</b>: ".$this->material."<br>";
        echo "<b>Volts</b>: ".$this->volts."V<br>";
    }

}
