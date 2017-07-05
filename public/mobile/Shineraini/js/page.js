var App = new App();

$(document).on("pageInit", function(e, pageId, $page) {
    if(pageId == "customer-edit") {
        seajs.use('mobile/customer.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-account-index'){ //钱包
        seajs.use('mobile/customer_account.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-account-deposit'){ //押金
        seajs.use('mobile/customer_account_deposit.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-account-record-index'){ //资金流水列表
        seajs.use('mobile/customer_account_record.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-payment-index'){ //支付信息列表
        seajs.use('mobile/customer_payment.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-hire-index'){ //用户租用纪录
        seajs.use('mobile/customer_hire.js', function (app) {
            app.index($);
        });
    }else if(pageId == 'customer-hire-view'){ //用户租用纪录详情
        seajs.use('mobile/customer_hire_view.js', function (app) {
            app.index($);
        });
    }



});



