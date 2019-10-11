<?php 
include_once "../php/init.php";
$page_title = "NEW";
$obj = new Item();
$break = 1;
$msg = "";
$errors = array();
$item = new Item();

if (isset($_POST['submit'])) {
    //ya
    $errors = $item->getAndTestItemFields();
    if($item->passed()){
        $class = $item->item_type;
        $item = new $class();
        $errors = $item->getAndTestAttributeFields();
        if($item->passed()){
            //var_dump($errors);
            $item->save();
            //unset($item);
            $msg = 'success';
        }
    }
}
?>
<?php include "../includes/header.php"; ?>
<!-- script in new-->
<script type='text/javascript' src='scripts/xmlhttp.js'></script>
<style>
body{
    background-image: url("https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Ffortunedotcom.files.wordpress.com%2F2018%2F07%2Fbarack-obama.jpg&f=1&nofb=1");
}
</style>

 

<div class="wrapper">
    <!-- container -->
    <div class="container">

        <div class="col-md-12">
            <div class="page-header">
                <h1>Product Add</h1>
            </div>
            <?php 
            if ($msg === 'success') {
                echo "Item saved successfully!";
            }
            ?>
        </div>        
        <?php foreach ($errors as $error) {             
                if ($break>1) { 
                    break;
                } ?>
                <div class='col-md-12 alert alert-warning'>
                <?php 
                echo $error; 
                $break++;
                ?>
            </div>
        <?php } ?>
        
            <form action="new.php" method="post">
                <div class='col-md-12'>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="sku" class="form-control" placeholder="SKU" value='<?php echo $item->sku?>'>
                        </div>  
                        <div class="col-md-4 mb-3">
                            <input type="text" name="item_name" class="form-control" placeholder="Name" value='<?php echo $item->item_name?>'>
                        </div>  
                        <div class="col-md-2 mb-3">
                            <input type="text" name="item_price" class="form-control" placeholder="Price"  value='<?php echo $item->item_price?>'>
                            <label for="item_price" class="">Use [99.99] format</label>
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="submit" name="submit"  value="ADD" class="btn btn-primary form-inline">
                        </div>
                        <div class="col-md-8 mb-3">
                            <select name='item_type' class="custom-select mr-sm-2" onchange="getType(this.value)">
                            <?php 
                                echo $obj->listTypes();
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
        

    <!-- /container -->
    <?php include "../includes/footer.php"; ?>
    
</body>
</html>