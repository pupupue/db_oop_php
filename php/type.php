<?php

class Type
{
    // Types and their descriptions are hardcoded here
    // add new attributes and descriptions at the same time
    // and if you add completly new attributes add them in the database
    // in item_attributes table (manualy)
    public $attributes = array(
        'Furniture'=>array('Height', 'Width', 'Length', 'Weight', 'Color', 'Material'),
        'Clock'=>array('Height', 'Width', 'Length', 'Weight', 'Color', 'Batteries', 'Type' ), 
        'Movie'=>array('Format', 'Year', 'Runtime', 'Language'),
        'Book'=>array('Pages', 'Author', 'Language'),
        'Lamp'=>array('Color', 'Material', 'Volts', 'Weight', 'Height', 'Width', 'Length')
    );
    public $description = array(
        'Furniture'=>'Please provide dimensions in Height, Width, Length (HxWxL)cm format,<br> Weight should be in (kg),<br> and please provide the Material (wood, metal, plastic).', 
        'Clock'=>'Please provide the clocks dimensions in Height, Width, Length (HxWxL)cm format,<br> Weight should be in (kg),<br> Battery size and quantity as such (1xAA,4xAAA,2xAA),<br> The types can be (Alarm, Desk, Wall, Grandfather etc).',  
        'Movie'=>'Please provide the format (Blu-ray,DVD)<br>Please provide the realease year(yyyy)<br>Please provide the The movie length in hour minute format(1h 42min)<br>and the language.', 
        'Book'=>'Please provide the page count, the author and the language. ',
        'Lamp'=>'Please provide the color,<br>as well as the Voltage (110, 120, ect),<br> Weight should be in (kg),<br> Please provide the Lamps dimensions in Height, Width, Length (HxWxL)cm format.'
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
    }

}
