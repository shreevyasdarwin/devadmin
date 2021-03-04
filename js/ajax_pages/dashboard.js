autoRefresh_div();

function autoRefresh_div() {
    // console.log('111');
    $.ajax({
        url: "ajax/dashboard.php",
        method: "POST",
        data: {dashboard: '1'},
        success: function (response) {
            // console.log(response);
            var json =  JSON.parse(response);
            //today's flight booking
            $('#todayflight').text(json.todayflight);
            //total flight booking
            $('#totalflight').text(json.totalflight);
            //total flight amount
            $('#totalflightamt').text(json.totalflightamt);
            //total Income
            $('#totalincome').text(json.totalincome);
            //total flight income
            $('#todayflightamt').text(json.todayflightamt);
            //total registered users
            $('#users').text(json.users);
            //total hotel booking
            $('#totalhotel').text(json.totalhotel);
            //todays hotel booking
            $('#todayhotel').text(json.todayhotel);
            //total hotel income
            $('#totalhotelamt').text(json.totalhotelamt);
            //today's hotel income
            $('#todayhotelamount').text(json.todayhotelamount);
            //total visa applications
            $('#visa').text(json.visa);
            //today's visa application
            $('#todayvisa').text(json.todayvisa);
            //rejected visa
            $('#r_visa').text(json.r_visa);
            //approved visa
            $('#a_visa').text(json.a_visa);
            //fetch coupons
            $('#coupons').text(json.coupons);
            //fetch margins
            $('#margins').text(json.margin);
            //business wallet
            $('#businesswallet').text(json.balance);
            //today registered users
            $('#todayusers').text(json.todayusers);
            //active users
            $('#activeusers').text(json.activeusers);
            //deactive users
            $('#deactiveusers').text(json.deactiveusers);
            //cancellation refund
            $('#cancelrefund').text(json.cancelrefund);
            //failed refund
            $('#failedrefund').text(json.failedrefund);
            //charter enq
            $('#charter').text(json.charter);
            //console.clear();
        }
    });
    // setTimeout(autoRefresh_div, 2000);
}
