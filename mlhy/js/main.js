;(function(){
    $("#J_menu").bind("click", function(){
        $("#J_silder_menu").css({
            "-webkit-transform": "translate3d(0, 0, 0)",
            "transform": "translate3d(0, 0, 0)"
        });
        $("#J_bg").show();
        $("#J_silder_menu_close").show().css({
            top: ($(window).height() - 124)/2
        });

        return false;
    });
    $("#J_bg").bind("click", function(){
        var _this = $(this);
        setTimeout(function () {
            $("#J_silder_menu").css({
                "-webkit-transform": "translate3d(-225px, 0, 0)",
                "transform": "translate3d(-225px, 0, 0)"
            });
            _this.hide();
            $("#J_silder_menu_close").hide();
        }, 10);

        return false;
    });
    $("#J_silder_menu_close").bind("click", function(){
        var _this = $(this);
        setTimeout(function () {
            $("#J_silder_menu").css({
                "-webkit-transform": "translate3d(-225px, 0, 0)",
                "transform": "translate3d(-225px, 0, 0)"
            });
            _this.hide();
            $("#J_bg").hide();
        }, 10);

        return false;
    });

    var swipeObj = Swipe(document.getElementById('J_silder'), {
        startSlide: 0,
        speed: 500,
        callback: function (pos, node) {
            $("#J_silder_index").find("span").removeClass("current").eq(pos).addClass("current")
        },
        transitionEnd: function () {

        }
    });

    var swipeObjVideo = Swipe(document.getElementById('J_silder_video'), {
        startSlide: 0,
        speed: 500,
        callback: function (pos, node) {
            
        },
        transitionEnd: function () {

        }
    });
})();