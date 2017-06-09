/**
 * Created by dell on 2017/6/9.
 */
var Shineraini = function () {

    return {
        init : function () {
            $(".back-link").on('click',function () {
                window.history.go(-1)
            })
        },

    }
}

jQuery(document).ready(function () {
    var tool = new Shineraini();
    tool.init(); // init metronic core componets
});