!(function () {
	$('#J_nav li').mouseenter(function () {
		if ($(this).attr('class') !== 'act') {
			$(this).addClass('cur');
		}
		$(this).siblings().stop().animate({
			opacity: 0.6
		}, 500)
	}).mouseleave(function () {
		if ($(this).attr('class') !== 'act') {
			$(this).removeClass('cur');
		}
		$(this).siblings().stop().animate({
			opacity: 1
		}, 500)
	});

	var scrollTop = $(window).scrollTop();
	var winHeight = $(window).height();
	$(window).scroll(function () {
		scrollTop = $(window).scrollTop();

		fade();
	});

	function fade() {
		$('.J_fade').each(function () {
			var fade = $(this).attr('data-fade');

			if (fade !== 'fade') {
				var top = $(this).offset().top;
				var height = $(this).height();

				if (
					top + 100 < scrollTop + winHeight
				) {
					$(this).animate({
						opacity: 1
					}, 500);
					$(this).attr('data-fade', 'fade');
				}
			}
		});
	}
	fade();

	$(window).resize(function () {
		winHeight = $(window).height();
	});

})();