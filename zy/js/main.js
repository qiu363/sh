!(function () {

	var obj = $('#slides li');

	$('#slides').css({
		width: $(window).width()
	});
	$('#slides li').css({
		width: $(window).width()
	});

	$(window).resize(function () {
		$('#slides').css({
			width: $(window).width()
		});
		$('#slides li').css({
			width: $(window).width()
		});

		winHeight = $(window).height();
	});

	var index = 0;
	var timer = '';
	function ani() {
		timer = setInterval(function () {
			var tmpIndex = index;
			index++;
			if (index >= $('#slides li').length) {
				index = 0;
			}
			$('#slides li').eq(tmpIndex).animate({
				opacity: 0
			}, 800);
			$('#slides li').eq(index).animate({
				opacity: 1
			}, 800);

			$('#slides-index span').eq(index).addClass('cur').siblings().removeClass('cur');
		}, 5000);
	}
	ani();

	$('#slides-index span').mouseenter(function () {
		$(this).addClass('cur').siblings().removeClass('cur');

		var tmpIndex = index;
		index = $('#slides-index span').index(this);

		$('#slides li').eq(tmpIndex).animate({
			opacity: 0
		}, 800);
		$('#slides li').eq(index).animate({
			opacity: 1
		}, 800);
	})

	$('#slides').mouseenter(function () {
		clearInterval(timer);
	}).mouseleave(function () {
		ani();
	});

})();
