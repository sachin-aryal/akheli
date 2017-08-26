/**
 * Created by Samsung on 8/25/2017.
 */
$(document).ready(function () {

    $('#name').on('input', function() {

        var input=$(this);
        var is_name=input.val();

        if(is_name==''){
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
        if(is_email==''){
            $("#error_email").text("Please enter your email").addClass("valid");
        }else{

            if(!compare){
                $("#error_email").text("Please enter valid Email").addClass("valid");
            }else {
                $("#error_email").text("");
            }
        }
    });
    $('#password').on('input',function () {
        var input=$(this);
        var is_password=input.val();

        if(is_password.length == 0){
            $("#error_password").text("Please enter the password").addClass("valid");
        }else{
            if(is_password.length <= 8){
                $("#error_password").text("Password length should be more than 8").addClass("valid")
            }else{
                $("#error_password").text("");
            }

        }

    });
    $('#shop_name').on('input',function () {
        var input=$(this);
        var is_shop_name=input.val();

        if(is_shop_name.length == 0){
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
        if(is_phone_no.length == 0){
            $("#error_phone").text("Please enter the phone no").addClass("valid");
        }else {
            if (!check) {
                $("#error_phone").text("Please enter valid phone no").addClass("valid");
            } else {
                $("#error_phone").text("");
            }
        }

    });

})
