<?php 
/* Each Product (like book, furniture, ect) is extending an item class                         */
/* All products have SKU, name, price, type. (item specific attributes are handled by subclass)*/
/* OOP approach                                                                                */
class Item 
{
    protected static $db_table = "items";
    protected static $db_table_fields = array('sku','item_name','item_price','item_type','type_id');
    protected static $classes = array('Furniture','Clock','Movie','Book','Lamp');
    protected static $item_rules = array(
        'sku' => array(
            'required' => true,
            'min' => 8,
            'max' => 10
        ),
        'item_name'=> array(
            'required' => true,
            'min' => 2,
            'max' => 255
        ),
        'item_price'=> array(
            'required' => true,
            'double' => true,
        ),
        'item_type'=> array(
            'required' => true,

        ),
        'type_id'=> array(
            //nothing
        )
    );

    public $id;
    public $sku;
    public $item_name;
    public $item_price; 
    public $item_type;
    public $type_id;

    public $errors = array();

    /* findAll() returns all items                              */
    /* and returns objects with getById() method                */
    public static function findAll()
    {
        $sql = "SELECT * FROM ".static::$db_table;
        $items = static::findThisQuery($sql);
        $objects = array();
        foreach($items as $item){
            $class = static::getItemTypeById($item->id);
            # static class call (getById())
            $obj = $class::getById($item->id);
            $objects[] = $obj;
        }
        return $objects;
    }
    /* Returns full object by id                                 */
    public static function getById($id)
    {
        $sql = "SELECT * FROM ".static::$db_table." WHERE id=$id LIMIT 1";
        $result_array = static::findThisItem($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    /* query for getting type                                   */
    public static function getItemTypeById($id)
    {   
        global $db;
        $sql = "SELECT item_type FROM items WHERE id=$id LIMIT 1";
        $result = $db->query($sql);
        $result = mysqli_fetch_array($result);
        return array_shift($result);
    }
    /* findThisQuery($sql) finds query by sql code              */
    /* used for getting data from one db_table                  */
    public static function findThisQuery($sql)
    {
        global $db;
        $result_set = $db->query($sql);
        //make empty array
        $object_array = array();
        //fetch while loop
        while ($row = mysqli_fetch_array($result_set)) {
            $object_array[] = static::instantiation($row);
        }
        return $object_array;
    }  
    /* findThisItem($sql)                                        */
    /* input sql code for item                                   */
    /* output full item object array (with special attributes)   */ 
    /*     [items and furniture]    for example                  */
    public static function findThisItem($sql)
    {
        global $db;
        $result_set = $db->query($sql);
        //make empty array
        $object_array = array();
        //fetch while loop
        $calling_class = get_called_class();
        $the_obj = new $calling_class;
        // for each row
        while ($row = mysqli_fetch_array($result_set)) {
            // for each attribute
            foreach ($row as $attribute => $value) {
                if ($the_obj->hasAnAttribute($attribute)) {
                    $the_obj->$attribute = $value;
                    // setup attribute values
                }
            }
        }
        // second database table query
        // returns by type_id attribute values
        $the_obj = static::fillInAttributesFromDB($the_obj);
        $object_array[] = $the_obj;
        return $object_array;
    }

    /* fillInAttributesFromDB($the_obj)                                  */
    /* input: uncomplete object, return: by type_id correct attr-values  */  
    public static function fillInAttributesFromDB($the_obj)
    {
        global $db;
        $sql_attributes = "SELECT * FROM ".static::$db_attributes_table." WHERE type_id=$the_obj->type_id LIMIT 1";
        $result_set = $db->query($sql_attributes);
        while ($row = mysqli_fetch_array($result_set)) {
            foreach ($row as $attribute => $value) {
                //checks if its empty
                if ($the_obj->hasAnAttribute($attribute)) {
                    $the_obj->$attribute = $value;
                }
            } 
        }
        return $the_obj;
    }
    /* used to find query dynamically                                    */
    public static function instantiation($result)
    {
        $calling_class = get_called_class();
        $the_obj = new $calling_class;
        //the short way
        foreach ($result as $attribute => $value) {
            //checks if its empty
            if ($the_obj->hasAnAttribute($attribute)) {
                $the_obj->$attribute = $value;
            }
        }
        return $the_obj;
    }
    /* checks class its called from if it has these attributes           */
    private function hasAnAttribute($attribute)
    {
        $object_properties = get_object_vars($this);
       return array_key_exists($attribute, $object_properties);
        // if the passed in attribute exsists in obj_prop (like id)
        //then return true/false
    }

    /* Using predefined DB fields in class                                */
    /* returns properties dynamically                                     */
    protected function properties($db_table_fields)
    {
        $properties = array();
        //here only item so far
        foreach ($db_table_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
    /* cleans properties()                                                 */
    protected function cleanProperties($db_table_fields)
    {
        global $db;
        $clean_properties = array();
        foreach ($this->properties($db_table_fields) as $key => $value) {
            $clean_properties[$key] = $db->escape_string($value);
        }
        return $clean_properties;
    }

    /* save/delete/get methods have to deal with 2 db tables               */
    /* [items]&[furniture or book or movie ect.] */ 
    /* save logic                                                          */
    public function save()
    {
        global $db;
        // holding all object properties
        $properties = $this->cleanProperties(static::$db_attributes_table_fields);
        //imploding array keys of properties assoc array
        $sql = "INSERT INTO ".static::$db_attributes_table."(".implode(", ", array_keys($properties)).")";
        $sql .= "VALUES ('".implode("','", array_values($properties))."')";
        
        if ($db->query($sql)) {
            $this->type_id = $db->getCreatedId();
            $properties = $this->cleanProperties(static::$db_table_fields);
            //imploding array keys of properties assoc array
            $sql = "INSERT INTO ".static::$db_table."(".implode(", ", array_keys($properties)).")";
            $sql .= "VALUES ('".implode("','", array_values($properties))."')";
            if ($db->query($sql)) {
                $this->id = $db->getCreatedId();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* delete logic                                                   */
    public function delete()
    {
        global $db;
        $sql = "DELETE FROM ".static::$db_attributes_table." WHERE type_id=".$db->escape_string($this->type_id)." LIMIT 1";
        $db->query($sql);
        if (!mysqli_affected_rows($db->conn) == 1) {
            return false;
        }
        $sql = "DELETE FROM ".static::$db_table." WHERE id=".$db->escape_string($this->id)." LIMIT 1";
        $db->query($sql);        
        return (mysqli_affected_rows($db->conn) == 1) ? true : false;  
    }

    /* Deletes every selected checkbox                                */
    public function deleteProducts()
    {
        if (isset($_POST['submit'])) {
            foreach ($_POST['delete'] as $key => $id) {
                $class = static::getItemTypeById($id);
                $obj_to_delete = $class::getById($id);
                $obj_to_delete->delete();
            }
            return $msg = "success";
        }
    }

    /* shows input fields and description dynamically                  */
    public function getObjectTypes()
    {
        $result = "<div class='col-md-8'>";
        foreach (static::$db_attributes_table_fields as $table_fields => $v) {
            $result .="<input type='text' class='form-control' name='$v' placeholder='$v'><br>
            ";
        }
        $result .= "</div>";
        $result .="<div class='col-md-4 float-right'>".static::$description."</div>";
        return $result;
    }

    /* lists options dynamically from static::$classes array in item.php*/
    public function listTypes()
    {   
        $result = "<option value=''>Pick a type</option>";
        foreach (static::$classes as $value) {  
            $result .= "<option value='$value'>$value</option>";
        }
        return $result;
    }


    /*                                                                  */
    /* ERROR HANDLING                                                   */
    /*                                                                  */
    public function validate($field, $value, $rules)
    {
    $value = trim($value);
    foreach ($rules as $rule => $rule_value) {

        //echo "all rules as {$rule} => {$rule_value}<br>";
            if($rule === "required" && empty($value)){
                $this->addError($field." field is required!");
            } else {
                switch ($rule) {
                    case 'min':
                        if(strlen($value) < $rule_value){
                            $this->addError("{$field} must be longer than {$rule_value} characters.");
                        };
                    break;
                    
                    case 'max':
                        if(strlen($value) > $rule_value){
                            $this->addError("{$field} must be smaller than {$rule_value} characters.");
                        };
                    break;
                    
                    case 'double':
                        if (!preg_match('/^-?(?:\d+|\d*\.\d+)$/', $value)) {
                            $this->addError("{$field} must be a real number.");
                        }
                    break;

                    case 'int':
                        if (!is_numeric($value)) {
                            $this->addError("{$field} must be a number.");
                        }
                    break;
                    case 'symb':
                        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
                            $this->addError("{$field} must be a word.");
                        }
                    break;
                    case 'char':
                        if (!preg_match("/^[a-zA-Z]+$/", $value)) {
                            $this->addError("{$field} must be a word.");
                        }
                    break;
                    
                    
                    default:
                        # code...
                        break;
                }
            }
        }
    }
    /* validates the defined item fields                                */
    public function validateAllItemFields()
    {
        global $db;
        foreach (static::$db_table_fields as $key => $value) {
            //pass to validate function
            $rules = $this->findRules($value, static::$item_rules);
            $this->validate($value, $this->$value, $rules);
        }   
    }

    /* validates the corresponding attribute fields                      */
    public function validateAllAttributeFields()
    {
        global $db;
        foreach (static::$db_attributes_table_fields as $key => $value) {
            $rules = $this->findRules($value, static::$attribute_rules);
            $this->validate($value, $this->$value, $rules);
        }   
    }

    /* returns rule array for $value                                     */
    public function findRules($value, $rules_array)
    {
        //takes in value like pages and finds rules array()
        foreach ($rules_array as $key => $v) {
            if ($key == $value) {
                return $v; //this is rule array
            }
        }
    }

    /* adds error message to errors[]                                    */
    private function addError($error)
    {
        $this->errors[] = $error;
    }

    /* returns errors[]                                                  */
    public function errors()
    {
        return $this->errors;
    }

    /* passed() is true when errors array is === empty array             */
    public function passed()
    {
        return $this->errors === array();
    }

    /* gets $_POST variables dynamically and returns errors              */
    public function getAndTestItemFields()
    {
        foreach (static::$db_table_fields as $key => $value) {
            if (isset($_POST[$value])) {
                $this->$value = htmlspecialchars($_POST[$value]);
            }
        }   
        $this->validateAllItemFields(); 
        return $this->errors();
    }

    /* works the same way as getAndTestItemFields()                      */
    /* we need to check items side first because                         */
    /* new Class in new.php is created dynamically from the form         */
    /* and again we have 2 DB tables                                     */
    public function getAndTestAttributeFields()
    {
        $this->getAndTestItemFields();
        foreach (static::$db_attributes_table_fields as $key => $value) {
            //pass to validate function
            if (isset($_POST[$value])) {
                $this->$value = htmlspecialchars($_POST[$value]);
            }
        }   
        $this->validateAllAttributeFields();
        return $this->errors();
    }
    

}
