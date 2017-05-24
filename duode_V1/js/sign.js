!(function () {
	'use strict';

	var phoneReg = new RegExp('^\\d{11}$', '');
	var phoneInterval = 120;
	var activationYzm = 0;

	// 记住密码
	var remberPaw = 0;
	$('#J_signin_rempaw').click(function () {
		if (remberPaw === 0) {
			$(this).addClass('sign-rember-sel');
			remberPaw = 1;
		} else {
			$(this).removeClass('sign-rember-sel');
			remberPaw = 0;
		}
	});

	// 手机输入框
	$('.J_phone_txt').blur(function () {
		var phoneNum = $(this).val();
		if (phoneReg.test(phoneNum)) {
			$(this).parent().removeClass('sign-error');
		}
	});
	// 企业名输入框
	$('.J_company').blur(function () {
		var phoneNum = $(this).val();
		if (phoneReg.test(phoneNum)) {
			$(this).parent().removeClass('sign-error');
		}
	});
	// 密码输入框
	$('.J_paw_txt').blur(function () {
		var phoneNum = $(this).val();
		if (phoneReg.test(phoneNum)) {
			$(this).parent().removeClass('sign-error');
		}
	});
	// 验证码输入框
	$('.J_yzm_txt').blur(function () {
		var phoneNum = $(this).val();
		if (phoneReg.test(phoneNum)) {
			$(this).parent().removeClass('sign-error');
		}
	});

	// 登录
	$('#J_sign_btn').click(function () {
		var phoneNum = $('.J_phone_txt').val();
		if (!phoneReg.test(phoneNum)) {
			$('.J_phone_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_phone_txt').parent().removeClass('sign-error');

		var paw = $('.J_paw_txt').val().replace(/^\s*|\s*$/, '');
		if (paw === '') {
			$('.J_paw_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_paw_txt').parent().removeClass('sign-error');

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				phone: phoneNum,
				paw: paw,
				remberPaw: remberPaw
			},
			dataType: 'json',
			success: function (data) {
				$('.J_sign').hide();
				$('.J_sign_suc').show();
				setTimeout(function () {
					window.location.href = 'staffList.html';
				}, 2000);
			},
			error: function () {}
		});

		// 模拟登录成功
		$('.J_sign').hide();
		$('.J_sign_suc').show();
		setTimeout(function () {
			window.location.href = 'staffList.html';
		}, 2000);

		return false;
	});

	// 忘记密码
	$('#J_forget_paw').click(function () {
		var phoneNum = $('.J_phone_txt').val();
		if (!phoneReg.test(phoneNum)) {
			$('.J_phone_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_phone_txt').parent().removeClass('sign-error');

		var yzm = $('.J_yzm_txt').val().replace(/^\s*|\s*$/, '');
		if (yzm === '' || activationYzm === 0) {
			$('.J_yzm_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_yzm_txt').parent().removeClass('sign-error');

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				phone: phoneNum,
				yzm: yzm
			},
			dataType: 'json',
			success: function (data) {
				$('.J_sign').hide();
				$('.J_sign_comfirm').show();
			},
			error: function () {}
		});

		// 模拟修改密码验证成功
		$('.J_sign').hide();
		$('.J_sign_comfirm').show();

		return false;
	});
	// 重置密码
	$('#J_comfirm_paw').click(function () {
		var comfirmPaw = $('.J_comfirm_paw_txt').val().replace(/^\s*|\s*$/, '');
		if (comfirmPaw === '') {
			$('.J_comfirm_paw_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_comfirm_paw_txt').parent().removeClass('sign-error');

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				phone: phoneNum,
				paw: paw,
				remberPaw: remberPaw
			},
			dataType: 'json',
			success: function (data) {
				$('.J_sign_comfirm').hide();
				$('.J_sign_suc').show();
				setTimeout(function () {
					window.location.href = 'staffList.html';
				}, 2000);
			},
			error: function () {}
		});

		// 模拟重置密码成功
		$('.J_sign_comfirm').hide();
		$('.J_sign_suc').show();
		setTimeout(function () {
			window.location.href = 'staffList.html';
		}, 2000);

		return false;
	});

	// 个人注册
	$('#J_sign_up').click(function () {
		var phoneNum = $('.J_phone_txt').val();
		if (!phoneReg.test(phoneNum)) {
			$('.J_phone_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_phone_txt').parent().removeClass('sign-error');

		var yzm = $('.J_yzm_txt').val().replace(/^\s*|\s*$/, '');
		if (yzm === '' || activationYzm === 0) {
			$('.J_yzm_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_yzm_txt').parent().removeClass('sign-error');

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				phone: phoneNum,
				yzm: yzm
			},
			dataType: 'json',
			success: function (data) {
				$('.J_sign').hide();
				$('.J_sign_suc').show();
			},
			error: function () {}
		});

		// 模拟登录成功
		$('.J_sign').hide();
		$('.J_sign_suc').show();
		setTimeout(function () {
			window.location.href = 'staffList.html';
		}, 2000);

		return false;
	});

	// 企业注册
	$('#J_sign_up_com').click(function () {
		var company = $('.J_company').val().replace(/^\s*|\s*$/, '');
		if (company === '') {
			$('.J_company').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_company').parent().removeClass('sign-error');

		var phoneNum = $('.J_phone_txt').val();
		if (!phoneReg.test(phoneNum)) {
			$('.J_phone_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_phone_txt').parent().removeClass('sign-error');

		var yzm = $('.J_yzm_txt').val().replace(/^\s*|\s*$/, '');
		if (yzm === '' || activationYzm === 0) {
			$('.J_yzm_txt').focus().parent().addClass('sign-error');
			return false;
		}
		$('.J_yzm_txt').parent().removeClass('sign-error');

		$.ajax({
			url: '',
			type: 'GET',
			data: {
				company: company,
				phone: phoneNum,
				yzm: yzm
			},
			dataType: 'json',
			success: function (data) {
				$('.J_sign').hide();
				$('.J_sign_suc').show();
			},
			error: function () {}
		});

		// 模拟登录成功
		$('.J_sign').hide();
		$('.J_sign_suc').show();
		setTimeout(function () {
			window.location.href = 'staffList.html';
		}, 2000);

		return false;
	});

	// 发送验证码
	$('.J_get_yzm').click(function () {
		var that = $(this);
		var yzmDisable = that.attr('data-disable');
		if (yzmDisable === '1') {
			return false;
		}
		
		var phoneNum = $('.J_phone_txt').val();
		if (phoneReg.test(phoneNum)) {
			activationYzm = 1;
			that.addClass('sign-yzm-btn-disable').attr('data-disable', '1').html('正在发送...');
			$.ajax({
				url: '',
				type: 'GET',
				data: {phone: phoneNum},
				dataType: 'json',
				success: function (data) {
					var _phoneInter = phoneInterval;
					var timer = setInterval(function () {
						_phoneInter--;
						if (_phoneInter === 0) {
							that.removeClass('sign-yzm-btn-disable').attr('data-disable', '0').html('获取验证码');
						} else {
							that.html(_phoneInter + 'S');
						}
						
					}, 1000);
				},
				error: function () {}
			});

			$('.J_phone_txt').parent().removeClass('sign-error');

			// 临时模拟
			var _phoneInter = phoneInterval;
			var timer = setInterval(function () {
				_phoneInter--;
				if (_phoneInter === 0) {
					that.removeClass('sign-yzm-btn-disable').attr('data-disable', '0').html('获取验证码');
				} else {
					that.html(_phoneInter + 'S');
				}
				
			}, 1000);
		} else {
			$('.J_phone_txt').focus().parent().addClass('sign-error');
		}
	});

	$('.J_sign').css({
		marginTop: -$('.J_sign').outerHeight()/2
	});

})();