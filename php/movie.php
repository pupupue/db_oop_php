<?php


class Movie extends Item
{
    protected static $db_attributes_table = "movie";
    protected static $db_attributes_table_fields = array('format', 'year', 'runtime', 'language');
    protected static $description ='Please provide the format (Blu-ray,DVD)<br>Please provide the realease year(yyyy)<br>Please provide the The movie length in hour minute format(1h 42min)<br>and the language.';
    protected static $attribute_rules = array(
        'format' => array(
            'required' => true,
            'min' => 2,
            'max' => 255
        ),
        'year'=> array(
            'required' => true,
            'double' => true
        ),
        'runtime'=> array(
            'required' => true,
            /* 'runtime' => true */
        ),
        'language'=> array(
            'required' => true,
            'char' => true,
            'min' => 2,
            'max' => 255
        )
    );

    public $format;
    public $year;
    public $runtime;
    public $language;


    public function showItemDetails()
    {
        echo "<b>Format</b>: ".$this->format."<br>";
        echo "<b>Aired on</b>: ".$this->year."<br>";
        echo "<b>Runtime</b>: ".$this->runtime."<br>";
        echo "<b>Language</b>: ".$this->language."<br>";
    }

}
