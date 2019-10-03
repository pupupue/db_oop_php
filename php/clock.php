<?php


class Clock extends Item
{
    protected static $db_attributes_table = "clock";
    protected static $db_attributes_table_fields = array('height', 'width', 'length', 'weight', 'color', 'batteries', 'type');
    protected static $description = 'Please provide the clocks dimensions in Height, Width, Length (HxWxL)cm format,<br> Weight should be in (kg),<br> Battery size and quantity as such (1xAA,4xAAA,2xAA),<br> The types can be (Alarm, Desk, Wall, Grandfather etc).';
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
        'batteries'=> array(
            'required' => true,
            'symb' => true,
            'min' => 2,
            'max' => 255
        ),
        'type'=> array(
            'required' => true,
            'symb' => true,
            'min' => 2,
            'max' => 255
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
    public $batteries;
    public $type;

    public function showItemDetails()
    {
        echo "<b>Dimension</b>: ".$this->height." x ".$this->width." x ".$this->length."<br>";
        echo "<b>Color</b>: ".$this->color."<br>";
        echo "<b>Type</b>: ".$this->type."<br>";
        echo "<b>Batteries</b>: ".$this->batteries."<br>";
    }

}
