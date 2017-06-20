var App = new App();

$(document).on("pageInit", function(e, pageId, $page) {

    $(".link").on('click',function () {
        var url = $(this).data('url')
        if (url!=null){
            window.location.href = url;
        }
    })

    if(pageId == "customer-edit") {
        $(".form-submit").on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id');
        })
    }else if(pageId == 'customer-account-index'){
        $(".amt-item").on('click',function () {
            $(".amt-item").removeClass('amt-select')
            $(this).addClass('amt-select')
        })
    }


});



