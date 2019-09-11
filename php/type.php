<?php

class Type
{
    // Types and their descriptions are hardcoded here
    // add new attributes and descriptions at the same time
    // and if you add completly new attributes add them in the database
    // in item_attributes table
    public $attributes = array(
        'Furniture'=>array('Height', 'Width', 'Length', 'Weight'), 
        'Disk'=>array('Size'),
        'Material'=>array('Weight'),
        'Book'=>array('Pages','Author')
    );
    public $description = array(
        'Furniture'=>'Please provide dimensions in Height, Width, Length (HxWxL) format', 
        'Disk'=>'Please provide disk size (MB, GB)',
        'Material'=>'Please provide material weight in KG',
        'Book'=>'Please provide the page count and the author'
    );

    //getDescription() is used to dynamically display description when selecting options
    public function getDescription($key)
    {
        return $this->description[$key];
    } 
    //getType() is used to generate input fields
    public function getType($key)
    {
        return $this->attributes[$key];
    }   

    //function listTypes() lists all of the Types and their coresponding attributes
    //used to make the select dynamic in new.php page
    public function listTypes()
    {   
        echo "<option value=''>Pick a type</option>";
        $keys = array_keys($this->attributes);
        foreach ($keys as $key) {  
            echo "<option value='$key'>$key</option>";
        }
    }// end of listTypes()

}
