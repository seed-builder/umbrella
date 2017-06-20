var App = new App();

$(document).on("pageInit", function(e, pageId, $page) {

    $(".link").on('click',function () {
        var url = $(this).data('url')
        if (url!=null){
            window.location.href = url;
        }
    })

    if(pageId == "customer-edit") {
        seajs.use('mobile/customer.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-account-index'){
        seajs.use('mobile/customer_account.js', function (app) {
            app.index($);
        });
    }


});



