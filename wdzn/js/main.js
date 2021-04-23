var swiper = new Swiper('.swiper-container', {
  autoplay : 5000,
  loop : true,
  pagination: '.swiper-pagination',
  paginationClickable: true
});

$(window).bind('scroll', function () {
  var scoTop = $(window).scrollTop();
  var heaHeight = $('.header').height();

  var cur = 0
  $('.J_title').each(function () {
    var top = $(this).offset().top;
    if (top < scoTop + heaHeight + 10) {
      cur = $('.J_title').index(this) + 1
    }
  });
  $('#J_nav a').siblings().removeClass('cur').eq(cur).addClass('cur');
});

$('#J_nav a, #J_nav_f span').click(function () {
  var mod = $(this).attr('data-mod');
  var heaHeight = $('.header').height();

  if (!mod) {
    $('html, body').animate({
      scrollTop: 0
    }, 500);
  } else {
    $('.J_title').each(function () {
      var tmod = $(this).attr('data-mod');
      if (mod === tmod) {
        var top = $(this).offset().top;
        $('html, body').animate({
          scrollTop: top - heaHeight
        }, 500);
      }
    });
  }

  return false;
});

$('#J_menu').click(function () {
  if ($(this).hasClass('menu-open')) {
    $('#J_nav').removeClass('nav-open');
    $(this).removeClass('menu-open');
  } else {
    $('#J_nav').addClass('nav-open');
    $(this).addClass('menu-open');
  }
});
