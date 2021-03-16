const accpetVisa = (e) => {
    const id = e.getAttribute("data-id");
    $.ajax({
        url: 'ajax/visa.php',
        method: 'POST',
        data: { accpetVisa: '1', id: id },
        success: function(response){
            // console.log(response);
            location.reload()
        }
    })
}

const rejectVisa = (e) => {
    const id = e.getAttribute("data-id");
    $.ajax({
        url: 'ajax/visa.php',
        method: 'POST',
        data: { rejectVisa: '1', id: id },
        success: function(response){
            // console.log(response);
            location.reload()
        }
    })
}