/**
 * Created by Samsung on 8/25/2017.
 */
function validateRegister() {

    $('#name').on('input', function() {

        var input=$(this);
        var is_name=input.val();
        if(is_name === ''){
            $("#error_name").text("Please enter your name").addClass("valid");

        }else {
            $("#error_name".test(""));
        }
    });
    $('#email').on('input',function () {
        var input=$(this);
        var re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
        var is_email=input.val();
        var compare=re.test(is_email);
        if(is_email === ''){
            $("#error_email").text("Please enter your email").addClass("valid");
        }else{

            if(!compare){
                $("#error_email").text("Please enter valid Email").addClass("valid");
            }else {
                $("#error_email").text("");
            }
        }
    });
    $('#register_password').on('input',function () {
        var input=$(this);
        var is_password=input.val();
        if(is_password === ''){
            $("#error_register_password").text("Please enter the password").addClass("valid");
        }else{
            if(is_password.length <= 8){
                $("#error_register_password").text("Password length should be more than 8").addClass("valid")
            }else{
                $("#error_register_password").text("");
            }
        }
    });
    $('#shop_name').on('input',function () {
        var input=$(this);
        var is_shop_name=input.val();

        if(is_shop_name === ''){
            $("#error_shop").text("Please enter the shop name").addClass("valid");
        }else{
            $("#error_shop").text("");
        }

    });

    $('#phone_no').on('input',function () {
        var input=$(this);
        var phone = /^\d{10}$/;
        var is_phone=input.val();
        var check=phone.test(is_phone);
        if(is_phone === ''){
            $("#error_phone").text("Please enter your phone number").addClass("valid");
        }else{

            if(!check){
                $("#error_phone").text("Please enter valid phone").addClass("valid");
            }else {
                $("#error_phone").text("");
            }
        }
    });
    $('#location').on('input',function () {
        var input=$(this);
        var is_location=input.val();

        if(is_location === ''){
            $("#error_location").text("Please enter the shop location").addClass("valid");
        }else{
            $("#error_location").text("");
        }

    });


}
$("#user_form_1").on("submit",function(){

    var input=$("#name");
    var is_value = input.val();
    if(is_value ===''){
        $("#error_name").text("Please enter name").addClass("valid");
        return false;
    }else{
        $("#error_name").text("");
    }

    input=$('#email');
    is_value = input.val();
    if(is_value ===''){
        $("#error_email").text("Please enter email").addClass("valid");
        return false;
    }else{
        $("#error_email").text("");
    }

    input=$('#register_password');
    is_value = input.val();
    if(is_value ===''){
        $("#error_register_password").text("Please enter password").addClass("valid");
        return false;
    }else{
        $("#error_register_password").text("");
    }

    input=$('#shop_name');
    is_value = input.val();
    if(is_value ===''){
        $("#error_shop").text("Please enter shop name").addClass("valid");
        return false;
    }else{
        $("#error_shop").text("");
    }

    input=$('#phone_no');
    is_value = input.val();
    if(is_value ===''){
        $("#error_phone").text("Please enter phone number").addClass("valid");
        return false;
    }else{
        $("#error_phone").text("");
    }

    input=$('#location');
    is_value = input.val();
    if(is_value ===''){
        $("#error_location").text("Please enter location").addClass("valid");
        return false
    }else{
        $("#error_location").text("");
    }


});

function validateProduct(){

    $('#product_name').on('input', function() {

        var input=$(this);
        var is_name=input.val();

        if(is_name ===''){
            $("#error_product_name").text("Please enter product name").addClass("valid");
        }else{
            $("#error_product_name").text("");
        }
    });

    $('#category').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_category").text("Please enter category").addClass("valid");
        }else{
            $("#error_category").text("");
        }
    });

    $('#weight').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_weight").text("Please enter minimum order").addClass("valid");
        }else{
            $("#error_weight").text("");
        }
    });

    $('#price').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_price").text("Please enter price").addClass("valid");
        }else{
            $("#error_price").text("");
        }
    });
    $('#size').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_size").text("Please enter size").addClass("valid");
        }else{
            $("#error_size").text("");
        }
    });
    $('#color').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_color").text("Please enter color").addClass("valid");
        }else{
            $("#error_color").text("");
        }
    });

    $('#description').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_description").text("Please enter description").addClass("valid");
        }else{
            $("#error_description").text("");
        }
    });

    $("#product_form_1").on("submit",function(){

        var input=$("#product_name");
        var is_val = input.val();
        if(is_val ===''){
            $("#error_product_name").text("Please enter product name").addClass("valid");
            return false;
        }else{
            $("#error_product_name").text("");
        }

        input=$('#category');
        is_val = input.val();
        if(is_val ===''){
            $("#error_category").text("Please enter category").addClass("valid");
            return false;
        }else{
            $("#error_category").text("");
        }

        input=$('#weight');
        is_val = input.val();
        if(is_val ===''){
            $("#error_weight").text("Please enter minimum order").addClass("valid");
            return false;
        }else{
            $("#error_weight").text("");
        }

        input=$('#price');
        is_val = input.val();
        if(is_val ===''){
            $("#error_price").text("Please enter price").addClass("valid");
            return false;
        }else{
            $("#error_price").text("");
        }

        input=$('#size');
        is_val = input.val();
        if(is_val ===''){
            $("#error_size").text("Please enter size").addClass("valid");
            return false;
        }else{
            $("#error_size").text("");
        }

        input=$('#color');
        is_val = input.val();
        if(is_val ===''){
            $("#error_color").text("Please enter color").addClass("valid");
            return false
        }else{
            $("#error_color").text("");
        }

        input=$('#description');
        is_val = input.val();
        if(is_val ===''){
            $("#error_description").text("Please enter description").addClass("valid");
            return false
        }else{
            $("#error_description").text("");
        }
        return true;
    });
}


function validateOrder(){

    $('#description').on('input', function() {

        var input=$(this);
        var is_des=input.val();

        if(is_des ===''){
            $("#error_description").text("Please enter product description").addClass("valid");
        }else{
            $("#error_description").text("");
        }
    });
    $('#size').on('input', function() {

        var input=$(this);
        var is_size=input.val();

        if(is_size ===''){
            $("#error_size").text("Please select preferred size").addClass("valid");
        }else{
            $("#error_size").text("");
        }
    });

    $('#color').on('input', function() {

        var input=$(this);
        var is_color=input.val();

        if(is_color ===''){
            $("#error_color").text("Please select preferred color").addClass("valid");
        }else{
            $("#error_color").text("");
        }
    });

    $('#quantity').on('input', function() {

        var input=$(this);
        var is_quan = input.val();

        if(is_quan ===''){
            $("#error_quantity").text("Please enter quantity").addClass("valid");
        }else{
            if(is_quan<10){
                $("#error_quantity").text("Please enter valid quantity").addClass("valid");
            }else {
                $("#error_quantity").text("");
            }

        }
    });




    $("#order_form_1").on("submit",function(){

        var input=$("#description");
        var is_des = input.val();
        if(is_des ===''){
            $("#error_description").text("Please enter product description").addClass("valid");
            return false;
        }else{
            $("#error_description").text("");
        }

        input=$('#quantity');
        is_quan = input.val();
        if(is_quan ===''){
            $("#error_quantity").text("Please enter quantity").addClass("valid");
            return false;
        }else{
            $("#error_quantity").text("");
        }

        input=$('#size');
        is_size = input.val();
        if(is_size ===''){
            $("#error_size").text("Please enter desired size").addClass("valid");
            return false;
        }else{
            $("#error_size").text("");
        }

        input=$('#color');
        is_color = input.val();
        if(is_color ===''){
            $("#error_color").text("Please enter desired color").addClass("valid");
            return false;
        }else{
            $("#error_color").text("");
        }
    });
}