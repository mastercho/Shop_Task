<?php
$obj_category = new category();
$result_category = $obj_category->view_category();

$obj_product = new product();
?>

<div class="col-md-3">

    <div class="col-sm-12" id="dropdown">
        <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".category">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible navbar-brand">Category</span>
                </div>
                <div class="navbar-collapse collapse category">
                    <ul class="nav navbar-nav">
                        <?php
                        while ($row_category = $result_category->fetch_array()) {
                            $obj_product->product_category = $row_category['category_name'];
                            $result_product = $obj_product->get_product_by_category();
                            ?>  
                            <li>
                                <a href="<?php echo (BASE_URL); ?>products/product_category.php?c=<?php echo $row_category['category_name'] ?>" 
                                   class=" 
                                   <?php
                                   if ($row_category["status"] == "Active") {
                                       echo '';
                                   } else {
                                       echo 'hidden';
                                   }
                                   ?>">
                                    <span class="glyphicon glyphicon-menu-right"></span>
                                    <?php
                                    echo $row_category["category_name"];
                                    ?>
                                    <span class="badge"><?php echo $result_product->num_rows; ?></span>       


                                </a>
                            </li><br> 
                            <?php
                        }
                        ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    $obj_brand = new brand();
    $result_brand = $obj_brand->view_brand();
    ?>
    <div class="col-sm-12" id="dropdown">
        <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".brand">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible navbar-brand active">Brand</span>
                </div>
                <div class="navbar-collapse collapse brand">
                    <ul class="nav navbar-nav">
                        <?php
                        while ($row_brand = $result_brand->fetch_array()) {
                            $obj_product->product_brand = $row_brand['brand_name'];
                            $result_product = $obj_product->get_product_by_brand();
                            ?>  
                            <li>
                                <a href="<?php echo (BASE_URL); ?>products/product_brand.php?b=<?php echo $row_brand['brand_name'] ?>" 
                                   class=" 
                                   <?php
                                   if ($row_brand["status"] == "Active" & $result_product->num_rows > 0) {
                                       echo '';
                                   } else {
                                       echo 'hidden';
                                   }
                                   ?>">
                                    <span class="glyphicon glyphicon-menu-right"></span>
                                    <?php
                                    echo $row_brand["brand_name"];
                                    ?>
                                    <span class="badge "><?php echo $result_product->num_rows; ?></span>       


                                </a>
                            </li><br> 
                            <?php
                        }
                        ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>    


    <?php
    $obj_ad = new ads();
    $result_ad = $obj_ad->get_ad();
    ?>    
    <div class="col-md-12" id="ads">

        <?php
        $counter = 1;

        while ($row_ad = $result_ad->fetch_array()) {
            //print_r($row_ad);
            if ($row_ad["status"] == "Active") {
                ?>
                <div class="thumbnail">
                    <a href="" title="<?php echo $row_ad["ad_description"]; ?>" data-toggle="modal" data-target="#<?php echo $row_ad['ad_ID'] ?>">
                        <img id="" class="img-responsive " src="<?php echo (BASE_URL); ?>images/ads/<?php echo $row_ad["ad_name"]; ?>/<?php echo $row_ad["ad_image"]; ?>">
                    </a>                    
                </div>

                <?php
            } else {
                echo '';
            }
            $counter++;
        }
        ?>

    </div>
    <?php
    $obj_m_ads = new ads();
    $result_modal = $obj_m_ads->get_ad();
    while ($row_m_ad = $result_modal->fetch_array()) {
        ?>    
        <div class="modal fade" id="<?php echo $row_m_ad['ad_ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $row_m_ad['ad_name']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <img  src="<?php echo (BASE_URL); ?>images/ads/<?php echo $row_m_ad["ad_name"]; ?>/<?php echo $row_m_ad["ad_image"]; ?>"> 
                    </div>
                    <div class="modal-footer">
                        <p class="pull-left">
                            <label class="control-label">Details : </label>
                            <?php echo $row_m_ad['ad_description']; ?>
                        </p>
                    </div>  
                </div>
            </div>
        </div>    
        <?php
    }
    ?>
</div>


