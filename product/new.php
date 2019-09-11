<?php 
include "../php/product.php";
include "../php/xmlhttp.php";
include "../php/show.php";
include "../config.php";
$item = new Product($conf->db);
$item->addNewProduct();
//echo var_dump($item->item_id) . "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>ADD</title>
 
    <!-- Bootstrap? -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
    <!-- custom css -->
    <link href="style/style.css" rel="stylesheet" media="screen">
 
</head>
<body>
 

 
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Product Add</h1>
                </div>
            </div>
            <div class='col-md-6'>
                <form action="" method="post">
                    
                    <input type="text" name="sku" placeholder="SKU">
                    <input type="text" name="item_name" placeholder="Name">
                    <input type="text" name="item_price" placeholder="Price">
                    <input type="submit" name="submit"  value="ADD" class="btn btn-primary">
                    <select name='myselect' onchange="getType(this.value)">
                        <?php 
                            $optionsType = new Type();
                            $optionsType->listTypes();
                        ?>
                    </select>
                    <div id="dynamic"></div>
                </form>
            </div>

        </div>
        <!-- /row -->
        
    </div>
    <!-- /container -->
    <?php include "footer.php"; ?>
    
</body>
</html>