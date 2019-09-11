<?php 
include "../php/product.php";
include "../php/show.php";
include "../config.php";

$item = new Product($conf->db);
$item->deleteProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js" ></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>LIST</title>
 
    <!-- Bootstrap? -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
    <!-- custom css -->
    <link href="style/style.css" rel="stylesheet" media="screen">
 
</head>
<body>


<script>
/* scirpt toggles all checkboxes created with showAll() */
function selectall(source) {
  checkboxes = document.getElementsByName('delete[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

 
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- Form begins here -->
            <form action="list.php" method="post">
                <div class="col-md-12">
                    <div class="page-header">
                        <div class='col-md-4'>
                            <h1>Product LIST</h1>
                        </div>
                        <div class='col-md-8'>
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
                                $result = $item->getItems(); 
                                $variable = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $variable++;
                                    $set = $item->showAll($row);
                            ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="col-item">
                                <div class="photo">
                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                    <div class="price col-md-7">
                                    <h5><b><?php echo $item->item_name ?></b></h5>
                                    </div>
                                    <div class="price col-md-5">
                                    <h5><?php echo $item->item_sku ?></h5>
                                    </div>
                                    <div class="separator clear-left"></div>
                                    <div class="price col-md-12">
                                    <?php $item->showTypeAttributes($set, $conf->db) ?>
                                    </div>
                                    <div class="price col-md-10">
                                        <h5 class="price-text-color">€ <?php echo $item->item_price ?></h5>
                                    </div>
                                    <div class="price col-md-2">
                                        <input class="form-check-input" type="checkbox" name="delete[]" value="<?php echo $item->item_id ?>">
                                        <p></p>
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
                        }/* end of while() */
                         ?>
                    </div>
                </div>
            </div>
        </form>
    </div>         
    <!-- /container -->
    <?php include "footer.php"; ?>
</body>
</html>