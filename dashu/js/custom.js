// ------- PRELOADER -------//
/* HTML document is loaded. DOM is ready.
-------------------------------------------*/
$(function(){

   // --------- HIDE MOBILE MENU AFTER CLIKING ON A LINK ------- //
  $('.navbar-collapse a').click(function(){
      $(".navbar-collapse").collapse('hide');
  });

  var timerTips = 0;
  $('.navbar-collapse a').mouseenter(function (e) {
    $('#J_tips').html($(this).html()).fadeIn();

    timerTips = setTimeout(function () {
      $('#J_tips').fadeOut();
    }, 3000);

    var x = e.originalEvent.x;
    var y = e.originalEvent.y;

    $('#J_tips').css({
      left: x + 15,
      top: y + 15
    });
  }).mousemove(function (e) {
    var x = e.originalEvent.x;
    var y = e.originalEvent.y;

    $('#J_tips').css({
      left: x + 15,
      top: y + 15
    });
  }).mouseleave(function (e) {
    $('#J_tips').hide();
    clearTimeout(timerTips);
  });

  $('.navbar-toggle').click(function () {
    var isShow = $(this).attr('data-show');

    if (isShow == '1') {
      $('.navbar-collapse').hide();
      $(this).attr('data-show', 0);
    } else {
      $('.navbar-collapse').show();
      $(this).attr('data-show', 1);
    }
  });

  // ------- WOW ANIMATED ------ //

  // ------- GOOGLE MAP ----- //


  // ------- JQUERY PARALLAX ---- //
  function initParallax() {
    $('#contact').parallax("100%", 0.9);
    $('#shoupro').parallax("100%", 0.5);
    $('#shoulinks').parallax("100%", 0.8);
  }
  initParallax();
});

$(".cprow a").hover(function() {
	$(this).find("span").stop().animate({top: "0px"}, 400);
}, function() {
	$(this).find("span").stop().animate({top: "290px"}, 400);
});


$(".shouabout").hover(function() {
	$(this).find(".comneimore").addClass("animated rotateIn");
	$(this).find(".about_tu").addClass("animated bounceIn");
}, function() {
	$(this).find(".comneimore").removeClass("animated rotateIn");
	$(this).find(".about_tu").removeClass("animated bounceIn");
});

//javascript Document
function SuCaiJiaYuan(){
  this.init();
}

SuCaiJiaYuan.prototype = {
  constructor: SuCaiJiaYuan,
  init: function(){
    this._initBackTop();
  },
  _initBackTop: function(){
    var $backTop = this.$backTop = $('<div class="cbbfixed">'+
            '<a class="gotop cbbtn">'+
              '<span class="up-icon"></span>'+
            '</a>'+
          '</div>');
    $('body').append($backTop);

    $(".gotop").click(function(){
      $("html, body").animate({
        scrollTop: 0
      }, 800);
    });

    var timmer = null;
    $(window).bind("scroll",function() {
            var d = $(document).scrollTop(),
            e = $(window).height();
            0 < d ? $backTop.css("bottom", "10px") : $backTop.css("bottom", "-90px");
      clearTimeout(timmer);
      timmer = setTimeout(function() {
                clearTimeout(timmer)
            },100);
     });
  }

}

var SuCaiJiaYuan = new SuCaiJiaYuan();
