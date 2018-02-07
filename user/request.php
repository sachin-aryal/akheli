<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:38 PM
 */
if (!isset($_SESSION)) {session_start();};
include_once "../shared/auth.php";
redirectIfNotAdmin();
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
$quotations = getQuotationList($conn);


?>
<script type="text/javascript">
    (function defer() {
        if (window.jQuery) {
            if (!$.fn.dataTableExt) {
                setTimeout(function () {
                    defer()
                }, 50);
            } else {
                $("#userList").DataTable();
            }
        } else {
            setTimeout(function () {
                defer()
            }, 50);
        }
    })();

</script>
<?php
include_once "../_header.php";
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title">
                    <h3><span class="fa fa-user"></span> Quotation List <small></small></h3>
                </div>

                <table id="userList" class="table table-responsive table-bordered custom-table bg-white shadow">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach ($quotations as $quotation) {
                        ?>
                        <tr>
                            <td><?php echo $quotation["email"] ?></td>
                            <td><?php echo $quotation["product_name"] ?> </td>
                            <td><img src="assets/images/<?php echo $quotation['image'] ?>" onclick="getModal('myImg<?php echo $quotation["id"] ?>')" class="myImg" id="myImg<?php echo $quotation["id"] ?>" style="width: 20px; height: 20px"> </td>
                            <td><a href="controller/request.php?id=<?php echo $quotation['id'] ?>&delete=true"><span class="fa fa-pencil-square-o"></span></a>  &nbsp; <span class="fa fa-user-times"></span></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>

        </div>
    </div>
</div>
<script>
    function getModal(id) {

        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById(id);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

</script>
<?php
include_once "../_footer.php";
?>

