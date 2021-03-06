function showmodal(id){
    $('#addWalletAmount').val(id);
    $('.modal').show();   
}
//insert into wallet 
$('#addWalletAmount').click(()=>{

    $('#addWalletAmount').text('Adding...');
    var amount = $('#walletAmount').val();
    var id = $('#addWalletAmount').val();
    // console.log(amount);
    // console.log(id);
    if(!amount){
        $('#amt_err').text('Enter a valid amount').css('color','red');
        $('#walletAmount').focus();
        return false;
    }
    $.ajax({
      type: 'POST',
      url : 'ajax/manage_user.php',
      data: { addWalletAmount: '1', id: id, amount: amount },
      success: function(response) {
          console.log(response);
        //   return
        if(response=='1'){
            // swal('success', 'Amount credited');
            location.reload();                
        }
      },
      error: function (jqXHR, exception) {
          console.log(jqXHR);
          console.log(exception);
      },
    });
});    


$(document).ready(function() {
    $('input[type="checkbox"]').change(function() {
        var id = $(this).val();

        if ($(this).is(":checked")) {
            //if checked it is activated
            $.ajax({    
                url: "ajax/manage_user.php",
                method: "POST",
                data: {activate: '1', id: id},
                success: function (result) {
                    swal("User has been Activated", {
                        icon: "success",
                    });
                }
            });
        } else {
            $.ajax({
                url: "ajax/manage_user.php",
                method: "POST",
                data: {deactivate: '1', id: id},
                success: function (data) {
                    swal("User has been deactivated", {
                        icon: "success",
                    });
                }
            });

        }
    });
});