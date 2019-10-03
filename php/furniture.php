<?php


class Furniture extends Item
{
/*     protected static $db_table = "items";
    protected static $db_table_fields = array('sku','item_name','item_price','item_type','type_id');
 */
    protected static $db_attributes_table = "furniture";
    protected static $db_attributes_table_fields = array('height', 'width', 'length', 'weight', 'color', 'material');
    protected static $description = 'Please provide dimensions in Height, Width, Length (HxWxL)cm format,<br> Weight should be in (kg),<br> and please provide the Material (wood, metal, plastic).';
    
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
        'color'=> array(
            'required' => true,
            'char' => true
        ),
        'material'=> array(
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

    public function showItemDetails()
    {
        echo "<b>Dimension</b>: ".$this->height." x ".$this->width." x ".$this->length."<br>";
        echo "<b>Color</b>: ".$this->color."<br>";
        echo "<b>Material</b>: ".$this->material."<br>";
    }

}
