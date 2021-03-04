$("#marginupdate").click(function() {
    $("#marginupdate").text('Please Wait...');
    var amount = $("#amount").val();
    $.ajax({
        url: "ajax/margin.php",
        method: "POST",
        data: {
            marginupdate: '1',
            amount: amount
        },
        success: function(response) {
            console.log(response);
        }
    });
});