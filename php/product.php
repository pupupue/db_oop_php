<?php
include "db.php";
include "type.php";


class Product extends Database
{

    /* method for adding new items. used in new.php page */
    public function addNewProduct()
    {
        $conn=$this->conn;
       
        if (isset($_POST['submit'])) {
            $type = new Type();
            $sku = $_POST['sku'];
            $item_name = $_POST['item_name'];
            $item_price = $_POST['item_price'];
            $item_type = $_POST['myselect'];
            /* empty handling first */
            if (empty($sku) || empty($item_name) || empty($item_price) || empty($item_type)) {
                header("Location: new.php?input=empty");
                exit();
            }
            /* handling dynamic attributes here */
            foreach ($type->getType($item_type) as $k => $v) {
                $v_value = $_POST[$v];
                if (empty($v_value)) {
                    header("Location: new.php?input=empty");
                    exit();
                }
            }
            /* empty handling end */
            //sanitizing inputs
            $sku = mysqli_real_escape_string($conn, $sku);
            $item_name = mysqli_real_escape_string($conn, $item_name);
            $item_price = mysqli_real_escape_string($conn, $item_price);
            $item_type = mysqli_real_escape_string($conn, $item_type);
            
            $sql = "INSERT INTO items(sku, item_name, item_price, item_type) VALUES
            ('$sku', '$item_name', '$item_price', '$item_type')";
            $result = mysqli_query($conn, $sql);
            //error checking
            if(!$result) {
                die('query die '.mysqli_error($conn));
            }
            //setting parameter id for next part
            $sql = "SELECT id FROM items WHERE sku='$sku'";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                die('query die '.mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                //setting item_id
                $item_id = $row['id'];
            }
            foreach ($type->getType($item_type) as $k => $v) {
                $v_value = $_POST[$v];
                $sql = "SELECT id FROM item_attributes WHERE name='$v'";
                $result = mysqli_query($conn, $sql);
                if(!$result) {
                    die('query die '.mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $i_a_id = $row['id'];
                }
                $v_value = mysqli_real_escape_string($conn, $v_value);
                $sql = "INSERT INTO item_attribute_values(item_id, attribute_id, attribute_value) VALUES
                ('$item_id', '$i_a_id', '$v_value')";
                $result = mysqli_query($conn, $sql);
                if(!$result) {
                    die('query die '.mysqli_error($conn));
                }  
            }
        }//isset
    }

    /* delete method for list page */
    public function deleteProducts()
    {
        $conn = $this->conn;
        if (isset($_POST['submit'])) {
            //echo var_dump($_POST['delete']);
            foreach ($_POST['delete'] as $key => $id) {
                $sql = "DELETE FROM items WHERE id='$id'";
                $itemResult = mysqli_query($conn, $sql);
                if(!$itemResult) {
                    die('query die '.mysqli_error($conn));
                }
                $sql = "DELETE FROM item_attribute_values WHERE item_id='$id'";
                $i_a_vResult = mysqli_query($conn, $sql);
                if(!$i_a_vResult) {
                    die('query die '.mysqli_error($conn));
                }
            }
            /* this breaks if php tag at the start has something infront of it */
            header("Location: list.php?msg=success");
        }//isset
    }// end of func deleteProducts
    

    public function showItem($set)
    {
        /* DEFAULT CASE */
        for ($i=0; $i < sizeof($set); $i++) {
            echo $set[$i]['attribute_name']. ": ".$set[$i]['attribute_value']."<br>";
        }
        //echo "default case";
    }

    //
    public function getItems()
    {
        $conn = $this->conn;
        $sql = "SELECT * FROM items";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Query failed '.mysqli_error($conn));
        }
        return $result;
    }
    //
    public function showAll($row)
    {
        $conn = $this->conn;
        
            $item_id = $row['id'];
            $this->item_id = $row['id'];
            $item_sku = $row['sku'];
            $this->item_sku = $item_sku;
            $item_name = $row['item_name'];
            $this->item_name = $item_name;
            $item_price = $row['item_price'];
            $this->item_price = $item_price;
            $item_type = $row['item_type'];
            $this->item_type = $item_type;

            //query to  get the attribute value 
            $sql_attributes = "SELECT * FROM item_attribute_values WHERE item_id='$item_id'";
            $result_attributes = mysqli_query($conn, $sql_attributes);
            if (!$result_attributes) {
                die('Query failed '.mysqli_error($conn));
            }
            //turn result_attributes into (array) $set so its easy to custimize later
            for ($set = array (); $row = $result_attributes->fetch_assoc(); $set[] = $row);
            //itterate $set to get names and add to the $set (assoc_array) 
            for ($i=0; $i < sizeof($set); $i++) {
                $attribute_id = $set[$i]['attribute_id'];
                $attribute_value = $set[$i]['attribute_value'];
                /* still itterating $set to get names from DB and add to $set */
                $sql_name = "SELECT * FROM item_attributes WHERE id='$attribute_id'";
                $result_name = mysqli_query($conn, $sql_name);
                if (!$result_name) {
                    die('Query failed '.mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($result_name)) {
                    /* HERE attribute_name is added to $set (assoc_array) */
                    $set[$i]['attribute_name'] = $row['name'];
                }
            }

            return $set;
            

    }// end of func showAll

    public function showTypeAttributes($set, $conf)
    {
        /* Based on item type a class is made for formating reasons */
        if (class_exists($this->item_type)) {
            $item = new $this->item_type($conf);
            $item->showItem($set);   
        } else {
            $this->showItem($set);
            
        }
    }

}
