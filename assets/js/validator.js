/**
 * Created by Samsung on 8/25/2017.
 */
function validateRegister() {

    $('#name').on('input', function() {

        var input=$(this);
        var is_name=input.val();

        if(is_name === ''){
            $("#error_name").text("Please enter your name").addClass("valid");
        }else{
            $("#error_name").text("");
        }
    });
    $('#email').on('input',function () {
        var input=$(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
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
        var is_phone_no=input.val();

        var pattern='/^\d{10}$/';
        var check=pattern.test(is_phone_no);
        if(is_phone_no === ''){
            $("#error_phone").text("Please enter the phone no").addClass("valid");
        }else {
            if (!check) {
                $("#error_phone").text("Please enter valid phone no").addClass("valid");
            } else {
                $("#error_phone").text("");
            }
        }

    });

}

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

    $('#min_order').on('input', function() {

        var input=$(this);
        var is_val = input.val();

        if(is_val ===''){
            $("#error_min_order").text("Please enter minimum order").addClass("valid");
        }else{
            $("#error_min_order").text("");
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

        input=$('#min_order');
        is_val = input.val();
        if(is_val ===''){
            $("#error_min_order").text("Please enter minimum order").addClass("valid");
            return false;
        }else{
            $("#error_min_order").text("");
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
