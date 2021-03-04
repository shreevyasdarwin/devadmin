function paid(e){
    var id = e.getAttribute("data-id");
    console.log(id);
    $.ajax({
        url: 'ajax/refundflightbooking.php',
        method: 'POST',
        data: {paid: '1', id: id},
        success: function (response) {
            console.log(response);
            if(response=='1'){
                swal("sucess", "Refund paid", "success")
                window.location.reload()
            }
        }
    })
}

function reject(e){
    var id = e.getAttribute("data-id");
    console.log(id);
    $.ajax({
        url: 'ajax/refundflightbooking.php',
        method: 'POST',
        data: {reject: '1', id: id},
        success: function (response) {
            console.log(response);
            if(response=='1'){
                swal("sucess", "Refund rejected", "success")
                window.location.reload()
            }
        }
    })
}


