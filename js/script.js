
$(document).ready(function() {

    $("#submit").click(function(){
        var username=$("#inputName").val();
        var password=$("#inputPassword").val();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: "name="+username+"&password="+password,

            success:function processData(data) {
            if (data=='pass') {
                window.location.replace('user_page.php');
            } else {

                    $('#message').html('<p id="fail" style="color:red;"><strong>Λανθασμένοι Κωδικοί</strong></p>');

            }
        } // end processData
        })

        return false;
     // end submit




});



});



