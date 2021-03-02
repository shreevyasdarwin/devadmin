// Login js
$("#login").click(function() {
    console.log(11111);
    const username = $("#username").val()
    const password = $("#password").val()
    if(!username){
        $("#name_err").html("<p class='text-danger'>Please fill out this field</p>")
        return false
    }
    if(!password){
        $("#pass_err").html("<p class='text-danger'>Please fill out this field</p>")
        return false
    }
    $.ajax({
        url: 'ajax/login.php',
        method: 'POST',
        data: { login: '1', username: username, password: password },
        success: function(response) {
            console.log('in');
            console.log(response);
            if(response=='3') {
                $("#please_wait").html("<button type='button' class='btn btn-sm btn-primary' disabled>PLease wait...</button>")
                setTimeout(() => {
                    window.location.href='dashboard.php'
                }, 1000);
            }
            if(response=='4') {
                location.reload();
            }
        }
    })
});

$('#forgotpass').click(function()
{
    $.ajax({
        url: "ajax.php",
        method: "POST",
        data: {action: 'forgotpass'},
        success: function (response) {
            $("#forgot_msg").html("<p class='text-success'>Username & Password has mailed to admin's email</p>")
            return;
        }
    });
});