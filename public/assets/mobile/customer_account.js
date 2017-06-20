/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {

        $(".amt-item").on('click',function () {
            $(".amt-item").removeClass('amt-select')
            $(this).addClass('amt-select')
        })
    }
})