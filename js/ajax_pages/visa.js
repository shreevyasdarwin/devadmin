const accpetVisa = (e) => {
    const id = e.getAttribute("data-id");
    $.ajax({
        url: 'ajax/visa.php',
        method: 'POST',
        data: { accpetVisa: '1', id: id },
        success: function(response){
            console.log(response);
            if(response=='1'){
                window.location.reload()
            }
        }
    })
}