!(function () {
	'use strict';

	// tab
	$('#J_tab a').click(function () {
        var index = $('#J_tab a').index(this);
        $(this).addClass('cur').siblings().removeClass('cur');
        $('.J_tab_cont').hide().eq(index).show();

        return false;
    });

    // 关闭弹窗
    $('.J_close').click(function () {
        $('.J_popup').hide();
        $('.J_popup_hid').hide();
        $('.J_popup_comfirm').hide();
        $('.J_popup_change').hide();
        $('#J_mask').hide();

        return false;
    });
    $('.J_add_staff').click(function () {
        $('.J_popup_2').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_pop_show_1').click(function () {
        $('.J_popup_1').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_pop_show_2').click(function () {
        $('.J_popup_6').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_pop_show_3').click(function () {
        $('.J_popup_3').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_pop_show_4').click(function () {
        $('.J_popup_4').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_pop_show_5').click(function () {
        $('.J_popup_5').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_change_master').click(function () {
    	$('.J_popup_change').show();
        $('#J_mask').show();

        return false;
    });

    $('.J_org_del').click(function () {
    	$('.J_popup_comfirm').show();
        $('#J_mask').show();

        return false;
    });
    $('.J_org_del1').click(function () {
        $('.J_popup_comfirm1').show();
        $('#J_mask').show();

        return false;
    });

    $('.J_add_staff_edit').click(function () {
        $(this).parent().parent().addClass('add-staff-i-c-edit');
    });
    $('.J_add_staff_cal').click(function () {
        $(this).parent().parent().parent().removeClass('add-staff-i-c-edit');

        return false;
    });

    // 组织架构
    var orgDelObj = '';
    $('.J_org_fold').click(function () {
        var isShow = $(this).attr('data-show');

        if (isShow === '1') {
            $(this).parent().children('.org-level2').hide();
            $(this).attr('data-show', 0).removeClass('org-level1-arrow-d').addClass('org-level1-arrow');
        } else {
            $(this).parent().children('.org-level2').show();
            $(this).attr('data-show', 1).removeClass('org-level1-arrow').addClass('org-level1-arrow-d');
        }
    });
    $('.J_org_move_up').click(function () {
        var parent = $(this).parent().parent().parent().parent();
        var index = $('.J_tab_cont > div').index(parent);

        if (index > 1) {
            $('.J_tab_cont > div').eq(index - 1).before(parent);
        }

        return false;
    });
    $('.J_org_move_down').click(function () {
        var parent = $(this).parent().parent().parent().parent();
        var index = $('.J_tab_cont > div').index(parent);

        if (index < $('.J_tab_cont > div').length) {
            $('.J_tab_cont > div').eq(index + 1).after(parent);
        }

        return false;
    });
    $('.J_org_del').click(function () {
        orgDelObj = $(this).parent().parent().parent().parent();

        return false;
    });
    $('.J_org_del_bm').click(function () {
        orgDelObj.remove();

        $('.J_popup_hid').hide();
        $('#J_mask').hide();
    });

    $('.J_remove_sea_lab').click(function () {
        $(this).parent().remove();
    });


    // 添加员工
    $('.J_org_addstaff').click(function () {

    });

    // 创建表单
    $('.J_form_del').click(function () {
        $(this).parent().parent().parent().remove();

        return false;
    });
    $('#J_pop_add_txt').click(function () {
        $(this).parent().before('<p><input class="add-staff-f-txt" type="text" name="" value="" placeholder=""><i class="J_pop_del_txt"></i></p>');
    });
    $(document).on('click', '.J_pop_del_txt', function () {
        $(this).parent().remove();
    });
    $('.J_c_f_moveup').click(function () {
        var parent = $(this).parent().parent().parent();
        var index = $('.J_create_f_table').index(parent);

        if (index > 0) {
            $('.J_create_f_table').eq(index - 1).before(parent);
        }
        return false;
    });
    $('.J_c_f_movedown').click(function () {
        var parent = $(this).parent().parent().parent();
        var index = $('.J_create_f_table').index(parent);

        if (index < $('.J_create_f_table').length) {
            $('.J_create_f_table').eq(index + 1).after(parent);
        }
        return false;
    });
    $('.J_c_f_moveup_s').click(function () {
        var parent = $(this).parent().parent().parent();
        var parentP = parent.parent();
        var index = parentP.find('.J_create_f_table_s').index(parent);

        if (index > 0) {
            parentP.find('.J_create_f_table_s').eq(index - 1).before(parent);
        }
        return false;
    });
    $('.J_c_f_movedown_s').click(function () {
        var parent = $(this).parent().parent().parent();
        var parentP = parent.parent();
        var index = parentP.find('.J_create_f_table_s').index(parent);

        if (index < parentP.find('.J_create_f_table_s').length) {
            parentP.find('.J_create_f_table_s').eq(index + 1).after(parent);
        }
        return false;
    });

    $('#J_addstaff_next_1').click(function () {
        $('#J_tab a').removeClass('cur').eq(1).addClass('cur');
        $('.J_tab_cont').hide().eq(1).show();

        return false;
    });
    $('#J_addstaff_next_2').click(function () {
        $('#J_tab a').removeClass('cur').eq(2).addClass('cur');
        $('.J_tab_cont').hide().eq(2).show();

        return false;
    });

    // 搜索
    $('.J_permission_txt').bind('input', function () {
        var val = $(this).val().replace(/^\s*|\s*$/, '');
        var parent = $(this).parent().parent();
        var isMatch = 0;
        var rex = new RegExp('(' + val + ')', 'g');console.log(rex);

        if (val === '') {
            $('.J_permission_sea_tips').hide();
        } else {
            parent.find('.J_permission_sea_tips li').each(function () {
                if ($(this).find('span').eq(3).html() !== undefined) {
                    var name = $(this).find('span').eq(0).html().replace(/\<.*?\>/g, '');
                    $(this).find('span').eq(0).html(name);
                    var phone = $(this).find('span').eq(3).html().replace(/\<.*?\>/g, '');
                    $(this).find('span').eq(3).html(phone);

                    if (rex.test(name)) {
                        name = name.replace(rex, '<i>$1</i>');
                        $(this).show().find('span').eq(0).html(name);
                        isMatch = 1;
                    } else if (rex.test(phone)) {
                        phone = phone.replace(rex, '<i>$1</i>');
                        $(this).show().find('span').eq(3).html(phone);
                        isMatch = 1;
                    } else {
                        $(this).hide();
                    }
                }
            });

            if (isMatch === 0) {
                $('.J_no_res').show();
            } else {
                $('.J_no_res').hide();
            }

            $('.J_permission_sea_tips').show();
        }
    });

    /* 下拉框组件 */
    $(document).on('click', '.J_widget_sel_txt', function () {
        $(this).parent().find('.J_widget_sel_down').show();

        return false;
    });
    $(document).on('click', '.J_widget_select span', function () {
        var val = $(this).parent().find('.J_widget_sel_txt').val();

        if (val !== '') {
            $(this).parent().removeClass('widget-ipt-seled');
            $(this).parent().find('.J_widget_sel_txt').val('');
        }
    });
    $(document).on('click', '.J_widget_sel_down li', function () {
        var txt = $(this).text();

        $(this).parent().parent().addClass('widget-ipt-seled').find('.J_widget_sel_txt').val(txt);

        $('.J_widget_sel_down').hide();

        return false;
    });
    $(document).on('click', 'body', function () {
        $('.J_widget_sel_down').hide();
    });
    // 单选
    $(document).on('click', '.J_widget_radio', function () {
        var seled = $(this).attr('data-seled');

        if (seled === '1') {
            $(this).removeClass('widget-ipt-radio-sel');
            $(this).attr('data-seled', 0);
        } else {
            $(this).addClass('widget-ipt-radio-sel');
            $(this).attr('data-seled', 1);
        }
    });

    if (typeof jeDate !== 'undefined') {
        // 日历控件
        jeDate({
            dateCell: '.J_date',
            format: 'YYYY-MM-DD',
            isinitVal: true,
            isTime: true
        });
        jeDate({
            dateCell: '.J_date1',
            format: 'YYYY-MM-DD',
            isinitVal: true,
            isTime: true
        });
        jeDate({
            dateCell: '.J_date2',
            format: 'YYYY-MM-DD',
            isinitVal: true,
            isTime: true
        });
        jeDate({
            dateCell: '.J_date3',
            format: 'YYYY-MM-DD',
            isinitVal: true,
            isTime: true
        });
        jeDate({
            dateCell: '.J_date4',
            format: 'YYYY-MM-DD',
            isinitVal: true,
            isTime: true
        });
    }


})();