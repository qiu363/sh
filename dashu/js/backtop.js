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
		
		
				$(".cbbfixed a").hover(function() {
		$(this).css("background","#333333");
	
	}, function() {
		$(this).css("background","#666666");
 
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