document.getElementById("changepassword").addEventListener("click", function(){
    var npass = document.getElementById("npass").value
    var cpass = document.getElementById("cpass").value
    if(!npass){
        document.getElementById("npass_err").innerHTML="<p class='text-danger'>Please fillout this field</p>"
        return
    } 
    if(!cpass){
        document.getElementById("cpass_err").innerHTML="<p class='text-danger'>Please fillout this field</p>"
        return
    } 
    $.ajax({
        url: 'ajax/changePassword.php',
        method: 'POST',
        data: { changepassword: '1', npass: npass, cpass: cpass },
        success: function(response){
            console.log(response);
            if(response=='3'){ 
                document.getElementById("response").innerHTML="<div class='alert alert-success' role='alert'>Password updated successfully!</div>"
                setTimeout(() => {
                    window.location.reload()
                }, 1000);
            }
        }
    })
})