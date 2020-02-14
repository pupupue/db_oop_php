<?php 
include "../php/init.php";
$page_title = "LIST";
$msg = "";
$obj = new Item();
$msg = $obj->deleteProducts();
$items = Item::findAll();

?>
<?php include "../includes/header.php"; ?>
 
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- Form begins here -->
            <form action="list.php" method="post">
                <div class="col-md-12">
                    <div class="page-header">
                        <div class='col-md-6'>
                            <h1>Product LIST</h1>
                            <h4>
                            <?php 
                            if ($msg === 'success') {
                                echo "Item/s deleted successfully!";
                            }
                            ?>
                            </h4>
                            
                        </div>
                        <div class='col-md-12'>
                            <input type="submit" name="submit"  value="DELETE" class="btn btn-danger right-side">
                            <label for="select-all" class="right-side-label">Check All</label>
                            <input class="form-check-input right-side-checkbox" id="select-all" name="select-all" type="checkbox" onClick="selectall(this)">

                        </div>
                    </div>
                </div>
        </div>
        <!-- /row -->
        <!-- end of header -->
                <div class="grid">
                    <div class="row">
                        <div class='col-md-12'>
                            <!-- Displaying every item here -->
                            <?php 
                                $variable = 0;
                                foreach ($items as $item):
                                    $variable++;
                            ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="col-item">
                                <div class="photo">
                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div><!-- end of div photo -->
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-7">
                                            <h5><b><?php echo $item->item_name ?></b></h5>
                                        </div>
                                        <div class="price col-md-5">
                                            <h5><?php echo $item->sku ?></h5>
                                        </div>
                                    <div class="separator clear-left"></div>
                                        <div class="price col-md-12">
                                            <?php $item->showItemDetails(); ?>
                                        </div>
                                        <div class="price col-md-10">
                                            <h5 class="price-text-color">€ <?php echo $item->item_price ?></h5>
                                        </div>
                                        <div class="price col-md-2">
                                            <input class="form-check-input" type="checkbox" name="delete[]" value="<?php echo $item->id ?>">
                                        </div>
                                    </div><!-- row -->
                                    <div class="separator clear-left"></div>
                                    <div class="clearfix"></div>
                                </div><!-- info -->
                            </div>
                        </div>
                        <?php
                        /* clearfix so the page doesnt break */
                            if ($variable%4==0) {
                                echo '<div class="clearfix hidden-sm-up"></div>';
                            }
                            endforeach;  
                         ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>  
     
    <!-- /container -->
    
</body>
<?php include "../includes/footer.php"; ?>
</html>