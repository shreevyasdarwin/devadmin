//Update Margin
$("#updatemargin").click(function() {
    $("#updatemargin").text('Please Wait..');
    var amount = $("#marginamt").val();
    $.ajax({
        url: "ajax/updatemargin.php",
        method: "POST",
        data: {marginupdate: '1', amount: amount},
        success: function (response) {
            // console.log(response);
            // return false;
            location.reload();
        }
    });
});