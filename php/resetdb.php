<?php 


$dbname = "scandi";
$servername = "localhost";
$username = "root";
$password = "";
$conn;

// create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn){
    die("Connection failed : " . mysqli_connect_error());
}


// creating 1
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

// execute query
if(mysqli_query($conn, $sql)){
  $conn = mysqli_connect($servername, $username, $password, $dbname);
    // sql to create new table
      // droping
      $sql = "DROP TABLE items, item_attributes, item_attribute_values";

      // execute query
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
    // sql to create new table
    $sql = " CREATE TABLE IF NOT EXISTS item_attributes
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR (50) NOT NULL
                    );";

    if (!mysqli_query($conn, $sql)){
        echo "Error creating table 2: " . mysqli_error($conn);
    }
    // sql to create new table
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


    ///inserts
    $sql = "INSERT INTO items(id, sku, item_name, item_price, item_type) VALUES
    ('1', '1234523', 'BOOK 1', '299.99', 'Book'),
    ('2', '4523523', 'BOOK 2 the 2nd', '299.99', 'Book'),
    ('3', '8933472', 'BOOK ABC', '11.99', 'Book'),
    ('4', '4532245', 'Table', '44.99', 'Furniture'),
    ('5', '4536323', 'Bigger Table', '54.99', 'Furniture'),
    ('6', '7345663', 'Biggest Table', '64.99', 'Furniture'),
    ('7', '6522545', 'King sized bed', '799.99', 'Furniture'),
    ('8', '8343863', 'CD az', '5.99', 'Disk'),
    ('9', '8365363', 'CD zy', '6.99', 'Disk'),
    ('10', '1222525', 'CD ty', '9.99', 'Disk')";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 1: " . mysqli_error($conn);
    }
   //insert 2
    $sql = "INSERT INTO item_attributes(id, name) VALUES
    ('1', 'Height'),
    ('2', 'Width'),
    ('3', 'Length'),
    ('4', 'Weight'),
    ('5', 'Size'),
    ('6', 'Pages'),
    ('7', 'Author')";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 2: " . mysqli_error($conn);
    }

    //insert 3
    $sql = "INSERT INTO item_attribute_values(id, item_id, attribute_id, attribute_value) VALUES
    ('1', '1', '7', 'JK Just Kidding'),
    ('2', '1', '6', '560'),
    ('3', '2', '7', 'JK Just Kidding'),
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
    ('23', '8', '5', '64'),
    ('24', '9', '5', '100'),
    ('25', '10', '5', '1000')
    ";

    if (!mysqli_query($conn, $sql)){
        echo "Error insert 3: " . mysqli_error($conn);
    }

    header("Location: ../product/list.php");
}else{
    echo "scandii didnt create";
}

