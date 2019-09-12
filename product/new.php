<?php 
include "../php/product.php";
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
    <!-- script -->
    <script type='text/javascript' src='scripts/xmlhttp.js'></script>
    <!-- Bootstrap? -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- custom css -->
    <link href="style/style.css" rel="stylesheet" media="screen">
 
</head>
<body>
 

<div class="wrapper">
    <!-- container -->
    <div class="container">

        <div class="col-md-12">
            <div class="page-header">
                <h1>Product Add</h1>
            </div>
        </div>
        
            <form action="" method="post">
                <div class='col-md-12'>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="sku" class="form-control" placeholder="SKU">
                        </div>  
                        <div class="col-md-4 mb-3">
                            <input type="text" name="item_name" class="form-control" placeholder="Name">
                        </div>  
                        <div class="col-md-2 mb-3">
                            <input type="text" name="item_price" class="form-control" placeholder="Price">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="submit" name="submit"  value="ADD" class="btn btn-primary form-inline">
                        </div>
                        <div class="col-md-8 mb-3">
                            <select name='myselect' class="custom-select mr-sm-2" onchange="getType(this.value)">
                            <?php 
                                $optionsType = new Type();
                                $optionsType->listTypes();
                            ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3"></div>

                        <div id="dynamic" class="form-group row"></div>
                    </div>
                </div>
                
            </form>
            <?php 
            if(isset($_GET['input'])){
                echo "Please fill out all fields.";
            }
            ?>
        </div>

    <div class="push"></div>
</div>
        <!-- /row -->
        
    </div>
    <!-- /container -->
    <?php include "../includes/footer.php"; ?>
    
</body>
</html>