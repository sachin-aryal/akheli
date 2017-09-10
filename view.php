<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/10/2017
 * Time: 9:12 PM
 */

include_once "_header.php";

?>
<!-- Modal -->
<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Make Order</h4>
            </div>
            <div class="modal-body">
                <p>Modal Form Here</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="row display-product-wrapper bg-white shadow">
        <div class="col-md-12 go-back">
            <a href= "index.php"><span class="fa fa-arrow-left"></span> Back </a>
        </div>
        <div class="col-md-4">
            <div class="product-view-image">
                <img src="public/img/shoe.png" alt="shoe">
            </div>

        </div>
        <div class="col-md-8 clearfix">
            <div class="col-md-12">
                <div class="product-title">Price</div>
                <div class="product-price">Rs 1200/-  <small>Listed in Best Seller <span class="fa fa-check-circle"></span></small></div>
            </div>
            <div class="col-md-4">
                <p class="product-title">Name</p>
                <p class="product-detail">Shoe</p>
            </div>
            <div class="col-md-4">
                <p class="product-title">Size</p>
                <p class="product-detail">20 / 30 / 50/ 60</p>
            </div>

            <div class="col-md-4">
                <p class="product-title">Brand</p>
                <p class="product-detail">Addidas</p>
            </div>

            <div class="col-md-4">
                <p class="product-title">Available Quantity</p>
                <p class="product-detail">100</p>
            </div>
            <div class="col-md-4">
                <p class="product-title">Colors</p>
                <p class="product-detail">Red / Black / Blue</p>
            </div>

            <div class="col-md-4">
                <p class="product-title">Someting</p>
                <p class="product-detail">Someting</p>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary margin-vertical" data-toggle="modal" data-target="#login"><span class="fa fa-shopping-cart"></span> &nbsp; Order</button>
            </div>
        </div>
    </div>
</div>
