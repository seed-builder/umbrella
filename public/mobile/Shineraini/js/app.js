var App = function () {
    var the;

    return {
        init: function () {
            the = this;

            $(function () {

            })
            // console.log($(".anchorBL").find('img'))
        },
        ajaxLink: function (url, success_callback, error_callback, fail_callback) {
            // block ui prevent double submit
            console.log(alert_id)
            App.blockUI({
                target: blockui_id,
                animate: true,
            });
            // load the form via ajax
            $.ajax({
                type: 'GET',
                //async: true,
                cache: false,
                url: url,
                dataType: "json",
                timeout: 10000,
                success: function (res) {
                    if (res.error) {

                        if (error_callback !== undefined) {
                            error_callback();
                        }
                    }
                    if (res.success) {
                        if (res.redirect_url) {
                            window.location.href = res.redirect_url;
                        } else {

                            if (success_callback !== undefined) {
                                success_callback();
                            }
                        }
                    }

                    App.unblockUI(blockui_id);
                },

                error: function (jqXHR, textStatus, errorThrown) {

                    if (fail_callback !== undefined) {
                        fail_callback();
                    }

                }

            });
        },

        ajaxData: function (url, success_callback, error_callback, fail_callback) {
            $.ajax({
                type: 'GET',
                //async: true,
                cache: false,
                url: url,
                dataType: "json",
                success: function (res) {
                    if (res.error) {

                        if (error_callback !== undefined) {
                            error_callback();
                        }
                    }

                    if (res.success) {
                        if (success_callback !== undefined) {
                            success_callback(res.data);
                        }
                    }

                },

                error: function (jqXHR, textStatus, errorThrown) {

                    if (fail_callback !== undefined) {
                        fail_callback();
                    }

                }

            });
        },


        ajaxForm: function (form_id, success_callback, error_callback, fail_callback) {
            layer.open({
                type: 2
                , content: '提交中'
            });

            $.ajax({
                type: 'POST',
                data: $(form_id).serialize(),
                //async: true,
                cache: false,
                url: $(form_id).attr('action'),
                dataType: "json",
                timeout: 10000,
                success: function (res) {

                    layer.closeAll();
                    if (res.message){
                        layer.open({
                            content: res.message
                            , btn: '我知道了'
                        });
                    }

                    if (res.code == 0){
                        if (success_callback !== undefined) {
                            success_callback(res.data);
                        }
                    }

                    if (res.code != 0){
                        if (error_callback !== undefined) {
                            error_callback();
                        }
                    }
                },

                error: function (jqXHR, textStatus, errorThrown) {
                    layer.open({
                        content:'系统繁忙，请稍后再试'
                        , btn: '我知道了'
                    });

                    if (fail_callback !== undefined) {
                        fail_callback();
                    }

                },

            });

        },
    }
}

jQuery(document).ready(function () {
    // var App = new App();
    // App.init();
});
