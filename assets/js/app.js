function addMoreProductDetails(){
    var uuid = makeId(25);
    $("#product_details_form").append("<div id='"+uuid+"'>" +

        "<div class='form-group col-md-6'><label for=\"size\">Size:</label>\n" +
        "    <input class='form-control' type=\"text\" name=\"size[]\"></div>\n" +
        "\n" +
        "    <div class='form-group col-md-6'><label for=\"color\">Color:</label>\n" +
        "    <input class='form-control' type=\"text\" name=\"color[]\"></div>\n" +
        "\n" +
        "    <span class='remove-description-option' type=\"button\" onclick=\"removeDiv('"+uuid+"')\"><span class='fa fa-close'></span></span>\n" +
        "    </div>");
}

function removeDiv(id){
    $("#"+id).remove();
}

function makeId(len) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRS213213234asdkhaskdTUVWX-909213YZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < len; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function submitForm(id){
    $("#"+id).submit();
}

function addToCart(item_id) {
    var data = {pid:item_id, add_to_cart: true};
    $.ajax({
        type: "POST",
        url: "controller/cart.php",
        data:data,
        success: function (data) {
            var messageType = "error";
            if(data.indexOf("Successfully") !== -1){
                messageType = "success"
            }
            $.notify(data, messageType);
        }, error: function (err) {

        }
    });
}


function calculateAmount(productId) {
    var price = $("#price-"+productId).text();
    var quantity = $("#quantity-"+productId).val();
    $("#subtotal-"+productId).text(price*quantity);
    var total_price = 0;
    $(".subtotal").each(function (i) {
        total_price+=parseInt($(this).text());
    });
    $("#total-price").text("Rs."+total_price);
}