<?php 
/* THIS IS MY 15min ALTERNATIVE TO USING A .sql FILE */
/* ITS MENT PURELY TO SIMPLIFY LIFE AND THERE IS NO REASON */
/* TO ANALYSE IT, IT WOULDNT EXSIST OUTSIDE OF A TEST ENVIROMENT */
$dbname = "123scandi321";
$servername = "localhost";
$username = "root";
$password = "";
$conn;

$conn = mysqli_connect($servername, $username, $password);
if (!$conn){
    die("Connection failed : " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if(mysqli_query($conn, $sql)){
  $conn = mysqli_connect($servername, $username, $password, $dbname);
      $sql = "DROP TABLE items, item_attributes, item_attribute_values";
      if(mysqli_query($conn, $sql)){

      }else{

      }
    $sql = " CREATE TABLE IF NOT EXISTS items
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      sku VARCHAR (50) NOT NULL,
                      item_name VARCHAR (50) NOT NULL,
                      item_price FLOAT,
                      item_type VARCHAR (50) NOT NULL
                    );";

    if (!mysqli_query($conn, $sql)){
        echo "Error creating table 1: " . mysqli_error($conn);
    }
    $sql = " CREATE TABLE IF NOT EXISTS item_attributes
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR (50) NOT NULL
                    );";

    if (!mysqli_query($conn, $sql)){
        echo "Error creating table 2: " . mysqli_error($conn);
    }
    $sql = " CREATE TABLE IF NOT EXISTS item_attribute_values
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      item_id INT(11) NOT NULL,
                      attribute_id INT(11) NOT NULL,
                      attribute_value VARCHAR (255),
                      FOREIGN KEY (item_id) REFERENCES items(id),
                      FOREIGN KEY (attribute_id) REFERENCES item_attributes(id)
                    );";

    if (!mysqli_query($conn, $sql)){
        echo "Error creating table 3: " . mysqli_error($conn);
    }
    $sql = "INSERT INTO items(id, sku, item_name, item_price, item_type) VALUES
    ('1', '1234523', 'BOOK one', '14.99', 'Book'),
    ('2', '4523523', 'BOOK de fromage', '9.99', 'Book'),
    ('3', '8933472', 'Das Book', '11.99', 'Book'),
    ('4', '4532245', 'Table', '44.99', 'Furniture'),
    ('5', '4536323', 'Bigger Table', '54.99', 'Furniture'),
    ('6', '7345663', 'Biggest Table', '64.99', 'Furniture'),
    ('7', '6522545', 'King sized bed', '799.99', 'Furniture'),
    ('8', '4328741', 'Big night lamp', '39.99', 'Lamp'),
    ('9', '2874324', 'Long lamp', '45.99', 'Lamp'),
    ('10', '1324511', 'Cheap Alarm Clock', '12.99', 'Clock'),
    ('11', '2583523', 'Wall Clock', '22.49', 'Clock'),
    ('12', '2342412', 'Old Western', '11.49', 'Movie')";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 1: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO item_attributes(id, name) VALUES
    ('1', 'Height'),
    ('2', 'Width'),
    ('3', 'Length'),
    ('4', 'Weight'),
    ('5', 'Color'),
    ('6', 'Pages'),
    ('7', 'Author'),
    ('8', 'Material'),
    ('9', 'Batteries'),
    ('10', 'Type'),
    ('11', 'Format'),
    ('12', 'Year'),
    ('13', 'Runtime'),
    ('14', 'Language'),
    ('15', 'Volts')";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 2: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO item_attribute_values(id, item_id, attribute_id, attribute_value) VALUES
    ('1', '1', '7', 'John Doe'),
    ('2', '1', '6', '560'),
    ('3', '2', '7', 'Dohn Joe'),
    ('4', '2', '6', '643'),
    ('5', '3', '7', 'Big John McCarthy'),
    ('6', '3', '6', '63'),
    ('7', '4', '1', '11'),
    ('8', '4', '2', '22'),
    ('9', '4', '3', '33'),
    ('10', '4', '4', '44'),
    ('11', '5', '1', '12'),
    ('12', '5', '2', '23'),
    ('13', '5', '3', '34'),
    ('14', '5', '4', '45'),
    ('15', '6', '1', '15'),
    ('16', '6', '2', '25'),
    ('17', '6', '3', '35'),
    ('18', '6', '4', '45'),
    ('19', '7', '1', '123'),
    ('20', '7', '2', '234'),
    ('21', '7', '3', '345'),
    ('22', '7', '4', '456'),
    ('23', '4', '5', 'Black'),
    ('24', '5', '5', 'White'),
    ('25', '6', '5', 'Black'),
    ('26', '1', '14', 'English'),
    ('27', '2', '14', 'French'),
    ('28', '3', '14', 'German'),
    ('29', '7', '5', 'Black'),
    ('30', '8', '1', '12.2'),
    ('31', '8', '2', '12.2'),
    ('32', '8', '3', '27'),
    ('33', '8', '4', '1.2'),
    ('34', '8', '5', 'Black'),
    ('35', '8', '8', 'Metal'),
    ('36', '8', '15', '110'),
    ('37', '9', '1', '15'),
    ('38', '9', '2', '15'),
    ('39', '9', '3', '66.5'),
    ('40', '9', '4', 'White'),
    ('41', '9', '5', '4.5'),
    ('42', '9', '8', 'Plastic'),
    ('43', '9', '15', '120'),
    ('61', '10', '1', '22.5'),
    ('44', '10', '2', '12.5'),
    ('45', '10', '3', '0.3'),
    ('46', '10', '4', '1.2'),
    ('47', '10', '5', 'Black'),
    ('48', '10', '9', '2xAA'),
    ('49', '10', '10', 'Alarm'),
    ('50', '11', '1', '22.5'),
    ('51', '11', '2', '22.5'),
    ('52', '11', '3', '6.5'),
    ('53', '11', '5', 'White'),
    ('54', '11', '4', '0.8'),
    ('55', '11', '9', '2xAA'),
    ('56', '11', '10', 'Wall'),
    ('57', '12', '11', 'Blu-ray'),
    ('58', '12', '12', '1956'),
    ('59', '12', '13', '1h 33min'),
    ('60', '12', '14', 'English'),
    ('62', '4', '8', 'Wood'),
    ('63', '5', '8', 'Wood'),
    ('64', '6', '8', 'Wood'),
    ('65', '7', '8', 'Wood')
    ";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 3: " . mysqli_error($conn);
    }

    header("Location: list.php");
}else{
    echo "scandii didnt create";
}

