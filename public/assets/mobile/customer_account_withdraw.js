/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {
        $(".form-submit").on('click', function () {
            App.ajaxForm('#form-id')
        })
    }
})