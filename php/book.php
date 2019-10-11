<?php


class Book extends Item
{
    protected static $db_attributes_table = "book";
    protected static $db_attributes_table_fields = array('pages', 'author', 'language');
    protected static $description = 'Please provide the page count, the author and the language. ';
    
    protected static $attribute_rules = array(
        'pages' => array(
            'required' => true,
            'int' => true
        ),
        'author'=> array(
            'required' => true,
            'symb' => true,
            'min' => 2,
            'max' => 255
        ),
        'language'=> array(
            'required' => true,
            'char' => true,
            'min' => 2,
            'max' => 20
        )
    );

    public $pages;
    public $author;
    public $language;

    public function showItemDetails()
    {
        echo "<b>Created by</b>: ".$this->author."<br>";
        echo "<b>Pages</b>: ".$this->pages."<br>";
        echo "<b>Written in</b>: ".$this->language."<br>";
    }

}
