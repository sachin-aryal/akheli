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
        if(is_password=''){
            $("#error_password").text("Please enter the password").addClass("valid");
        }else{
            if(is_password.length <= 8){
                $("#error_password").text("Password length should be more than 8").addClass("valid")
            }else{
                $("#error_password").text("");
            }
        }

    });


})
