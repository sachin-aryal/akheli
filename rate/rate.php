<?php
if(!isset($_SESSION)){session_start();} ;

include_once "../shared/auth.php";
include_once "../_header.php";
redirectIfNotAdmin();
$doller=getRate($conn,1);
?>

    <div class="container" style="width: 100%;margin: 0 auto">
        <div class="row" style="padding: 20px;height: 420px">
            <div id="outer-categories-slider" class="col-md-12">
                <?php include_once "../_dashsidebar.php"?>
                <div class="col-md-9">
                    <?php if(isset($_GET['edit_rate'])){ ?>
                        <div class="page-title">
                            <h3><span class="fa fa-plus"></span> Edit Dollor Rate </h3>
                        </div>
                        <form action="controller/rate.php" id="product_form_1" class="custom-form" method="post">
                            <div class="form-group">
                                <label>Rate:</label>
                                <input class="form-control" type="text" name="rate" id="rate" required value="<?php echo $doller["doller_rate"] ?>"/>
                            </div>
                            <input type="submit" class="btn btn-primary pull-left margin-vertical" name="update_rate" value="Save">
                        </form>

                    <?php }else{ ?>
                        <div class="page-title">
                            <h3><span class="fa fa-plus"></span> Dollor Rate </h3>
                        </div>
                        <h4>Rate: <?php echo $doller["doller_rate"] ?></h4>
                        <a href="rate/rate.php?edit_rate=rate" class="btn btn-default">Edit</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php
include_once "../_footer.php";
?>