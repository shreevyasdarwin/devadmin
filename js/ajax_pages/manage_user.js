
function showmodal(id){
    $('#modeltitle').text('Add Amount in wallet');
    $('#addWalletAmount').css('display','inline');
    $('#addWalletAmount').val(id);
    $('#minusWalletAmount').css('display','none');
    $('.modal').show();   
}
function showmodal1(id,amt){
    // console.log(amt);
    $('#modeltitle').text('Deduct Amount from wallet');
    $('#errmsg').text('');
    $('#walletAmount').val('');
    $('#minusWalletAmount').css('display','inline');
    $('#addWalletAmount').css('display','none');
    $('#actualwalletAmount').val(amt);
    $('#minusWalletAmount').val(id);
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

function only_num(amount){
    var amounts = amount = amount.replace(/[^0-9]/g, '').replace(/(\.*)/g, '');
    return amounts;
}

// Remove amount from wallet 
$('#minusWalletAmount').click(()=>{
    $('#minusWalletAmount').text('Please Wait...');
    var walletamt = $('#actualwalletAmount').val();
    var minusamount = only_num($('#walletAmount').val());
    var id = $('#minusWalletAmount').val();
    
    // console.log(minusamount);
    // return false;
    if(parseFloat(minusamount) > parseFloat(walletamt)){
        console.log(minusamount);
        console.log(walletamt);

        $('#errmsg').css('color','red');
        $('#errmsg').text('Minus amount cannot be greater than wallet amount');
        return false;
    }
    $.ajax({
        type: 'POST',
        url : 'ajax/manage_user.php',
        data: { minusWalletAmount: '1', id: id, amount: minusamount, walletamount:walletamt },
        success: function(response) {
            // console.log(response);
            // return
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

function changeStatus(id,value){

    var type;
    var newval;
    if(value == 1){
        type = 'Activated';
        newval = 0;
    }else{
        type = 'Deactivated';
        newval = 1;
    }
    
    $.ajax({    
        url: "ajax/manage_user.php",
        method: "POST",
        data: {changeStatus: '1',id:id,value:value},
        success: function (result) {

            if(result == 1){
                $('#checkbox'+id).val(newval);
                alert('user '+type);
            }else{
                alert('Something went wrong');
            }
            
        }
    });
}