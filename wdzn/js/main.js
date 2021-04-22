var swiper = new Swiper('.swiper-container', {
  autoplay : 5000,
  loop : true,
  pagination: '.swiper-pagination',
  paginationClickable: true
});

$(window).bind('scroll', function () {
  var winHeight = $(window).height();
  var scoTop = $(window).scrollTop();

  var cur = 0
  $('.J_title').each(function () {
    var top = $(this).offset().top;
    if (top < winHeight + scoTop + 20) {
      cur = $('.J_title').index(this)
    }
  });
  $('#J_nav a').siblings().removeClass('cur').eq(cur).addClass('cur');
});

$('#J_nav a').click(function () {
  var mod = $(this).attr('data-mod');

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
          scrollTop: top - 140
        }, 500);
      }
    });
  }


  return false;
});
