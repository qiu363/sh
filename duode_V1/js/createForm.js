!(function () {
	'use strict';

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

    var popupIndex = '';

    $('.J_pop_show_1').click(function () {
        $('.J_popup_1').show();
        $('#J_mask').show();

        popupIndex = $('.J_pop_show_1').index(this);

        return false;
    });
    $('.J_pop_show_2').click(function () {
        $('.J_popup_6').show();
        $('#J_mask').show();

        popupIndex = $('.J_pop_show_2').index(this);

        return false;
    });
    $('.J_pop_show_3').click(function () {
        $('.J_popup_3').show();
        $('#J_mask').show();

        popupIndex = $('.J_pop_show_3').index(this);

        return false;
    });
    $('.J_pop_show_4').click(function () {
        $('.J_popup_4').show();
        $('#J_mask').show();

        popupIndex = $('.J_pop_show_4').index(this);

        return false;
    });
    $('.J_pop_show_5').click(function () {
        $('.J_popup_5').show();
        $('#J_mask').show();

        popupIndex = $('.J_pop_show_5').index(this);

        return false;
    });
    $('.J_change_master').click(function () {
    	$('.J_popup_change').show();
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

    // 创建表单
    $(document).on('click', '.J_form_del', function () {
        $(this).parent().parent().parent().remove();

        return false;
    });
    $(document).on('click', '#J_pop_add_txt', function () {
        $('#J_add_sel_i_w').append('<p><input class="add-staff-f-txt J_add_sel_item" type="text" name="" value="" placeholder=""><i class="J_pop_del_txt"></i></p>');
    });
    $(document).on('click', '.J_pop_del_txt', function () {
        if ($('.J_add_sel_item').length > 1) {
            $(this).parent().remove();
        }
    });
    $(document).on('click', '.J_c_f_moveup', function () {
        var parent = $(this).parent().parent().parent();
        var index = $('.J_create_f_table').index(parent);

        if (index > 0) {
            $('.J_create_f_table').eq(index - 1).before(parent);
        }
        return false;
    });
    $(document).on('click', '.J_c_f_movedown', function () {
        var parent = $(this).parent().parent().parent();
        var index = $('.J_create_f_table').index(parent);

        if (index < $('.J_create_f_table').length) {
            $('.J_create_f_table').eq(index + 1).after(parent);
        }
        return false;
    });
    $(document).on('click', '.J_c_f_moveup_s', function () {
        var parent = $(this).parent().parent().parent();
        var parentP = parent.parent();
        var index = parentP.find('.J_create_f_table_s').index(parent);

        if (index > 0) {
            parentP.find('.J_create_f_table_s').eq(index - 1).before(parent);
        }
        return false;
    });
    $(document).on('click', '.J_c_f_movedown_s', function () {
        var parent = $(this).parent().parent().parent();
        var parentP = parent.parent();
        var index = parentP.find('.J_create_f_table_s').index(parent);

        if (index < parentP.find('.J_create_f_table_s').length) {
            parentP.find('.J_create_f_table_s').eq(index + 1).after(parent);
        }
        return false;
    });

    $(document).on('click', '.J_add_zd_btn', function () {
        var index = $('.J_add_zd_btn').index(this);
        $('.J_add_zd').eq(index).show();
        $(this).parent().hide();

        return false;
    });

    // 设置计算规则
    $(document).on('click', '.J_c_f_set_rule', function () {
        $(this).parent().hide();
        $(this).parent().parent().find('.J_c_f_btn').show();
        $(this).parent().parent().parent().find('.J_c_f_cal').css({
            display: 'inline-block'
        }).removeClass('add-staff-checkbox-sel').attr('data-master', 0).attr('data-sel', 0);
        $(this).parent().parent().find('.J_c_f_cal').addClass('add-staff-checkbox-sel').attr('data-master', 1);

        $('#J_calculator').show();

        $('#J_cal_gs').html('<span class="create-form-c-num">'+ $(this).parent().parent().find('.add-staff-t').html() +'</span>');

        return false;
    });
    $(document).on('click', '.J_c_f_btn_save', function () {
        $(this).parent().hide();
        $(this).parent().parent().find('.J_c_f_handle').show();

        $('.J_c_f_cal').hide();

        $('#J_calculator').hide();

        return false;
    });
    $(document).on('click', '.J_c_f_btn_cal', function () {
        $(this).parent().hide();
        $(this).parent().parent().find('.J_c_f_handle').show();

        $('.J_c_f_cal').hide();

        $('#J_calculator').hide();

        return false;
    });

    $(document).on('click', '.J_c_f_cal', function () {
        var isMaster = $(this).attr('data-master');

        if (isMaster !== '1') {
            var isSel = $(this).attr('data-sel');
            var index = $('.J_c_f_cal').index(this);
            if (isSel === '0') {
                $('#J_cal_gs').append('<span class="create-form-c-num J_c_f_c_n" data-index="'+ index +'">'+ $(this).parent().find('.add-staff-t').html() +'</span><i class="create-f-c-symbol create-f-c-s-c">+</i>');
                $(this).attr('data-sel', 1).addClass('add-staff-checkbox-sel');
            }
        }

        return false;
    });

    var calNumObj = '';
    $(document).on('click', '.J_c_f_c_n', function () {
        calNumObj = $(this);
    });

    $('body').bind('keydown', function (event) {
        if (event.keyCode === 8 || event.keyCode === 46) {
            if (calNumObj !== '') {
                var index = calNumObj.attr('data-index');
                $('.J_c_f_cal').eq(index).removeClass('add-staff-checkbox-sel').attr('data-sel', 0);
                calNumObj.next().remove();
                calNumObj.remove();

                calNumObj = '';

                return false;
            }
        }
    });

    $('#J_cal_ac').click(function () {
        $('.J_c_f_c_n').each(function () {
            var index = $(this).attr('data-index');
            $('.J_c_f_cal').eq(index).removeClass('add-staff-checkbox-sel').attr('data-sel', 0);
            $(this).next().remove();
            $(this).remove();
        });
    });

    // 编辑
    var editIndex = '';
    $(document).on('click', '.J_c_f_edit_txt', function () {
        editIndex = $('.J_c_f_edit_txt').index(this);
        $('.J_popup_1').show();
        $('.J_add_txt_form_title').val($(this).parent().parent().find('.add-staff-t').html());

        editObj = $(this).parent().parent();

        $('#J_mask').show();

        return false;
    });
    $(document).on('click', '.J_c_f_edit_num', function () {
        editIndex = $('.J_c_f_edit_txt').index(this);
        $('.J_popup_6').show();
        $('.J_add_txt_form_title').val($(this).parent().parent().find('.add-staff-t').html());

        editObj = $(this).parent().parent();

        $('#J_mask').show();

        return false;
    });
    $(document).on('click', '.J_c_f_edit_sel', function () {
        editIndex = $('.J_c_f_edit_txt').index(this);
        $('.J_popup_3').show();
        $('.J_add_txt_form_title').val($(this).parent().parent().find('.add-staff-t').html());

        editObj = $(this).parent().parent();

        var html = '';
        editObj.find('.J_widget_sel_down a').each(function () {
            html += '<p><input class="add-staff-f-txt J_add_sel_item" type="text" name="" value="'+ $(this).html() +'"><i class="J_pop_del_txt"></i></p>';
        });
        $('#J_add_sel_i_w').html(html);

        $('#J_mask').show();

        return false;
    });
    $(document).on('click', '.J_c_f_edit_date', function () {
        editIndex = $('.J_c_f_edit_txt').index(this);
        $('.J_popup_4').show();
        $('.J_add_txt_form_title').val($(this).parent().parent().find('.add-staff-t').html());

        editObj = $(this).parent().parent();

        $('#J_mask').show();

        return false;
    });
    $(document).on('click', '.J_c_f_edit_tem', function () {
        editIndex = $('.J_c_f_edit_txt').index(this);
        $('.J_popup_5').show();
        $('.J_add_txt_form_title').val($(this).parent().parent().find('.add-staff-t').html());

        editObj = $(this).parent().parent();

        $('#J_mask').show();

        return false;
    });

    var editObj = '';
    // 添加文本字段
    $('.J_add_txt_form').click(function () {
        if (editObj === '') {
            var html = $('#J_tpl_txt').html();

            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            html = html.replace(/\<#title#\>/g, title);
            $('.J_add_zd_btn').eq(popupIndex).parent().before(html);
        } else {
            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            editObj.find('.add-staff-t').html(title);
            editObj = '';
        }

        $('.J_add_zd').eq(popupIndex).hide();
        $('.J_add_zd_btn').eq(popupIndex).parent().show();

        $('.J_popup').hide();
        $('#J_mask').hide();

        return false;
    });
    // 添加数值字段
    $('.J_add_num_form').click(function () {
        if (editObj === '') {
            var html = $('#J_tpl_num').html();

            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            html = html.replace(/\<#title#\>/g, title);
            $('.J_add_zd_btn').eq(popupIndex).parent().before(html);

            $('.J_popup').hide();
            $('#J_mask').hide();
        } else {
            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            editObj.find('.add-staff-t').html(title);
            editObj = '';
        }

        $('.J_add_zd').eq(popupIndex).hide();
        $('.J_add_zd_btn').eq(popupIndex).parent().show();

        return false;
    });
    // 添加选择字段
    $('.J_add_sel_form').click(function () {
        var title = $(this).parent().parent().find('.J_add_txt_form_title').val();
        var selItem = '';
        $('.J_add_sel_item').each(function () {
            selItem += '<li><a href="###">'+ $(this).val() +'</a></li>';
        });

        if (editObj === '') {
            var html = $('#J_tpl_sel').html();


            html = html.replace(/\<#title#\>/g, title);
            html = html.replace(/\<#sel#\>/g, selItem)
            $('.J_add_zd_btn').eq(popupIndex).parent().before(html);
        } else {
            editObj.find('.J_widget_sel_down').html(selItem);
            editObj.find('.add-staff-t').html(title);
            editObj = '';
        }

        $('.J_add_zd').eq(popupIndex).hide();
        $('.J_add_zd_btn').eq(popupIndex).parent().show();

        $('.J_popup').hide();
        $('#J_mask').hide();

        return false;
    });
    // 添加附件字段
    $('.J_add_tem_form').click(function () {
        if (editObj === '') {
            var html = $('#J_tpl_tem').html();

            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            html = html.replace(/\<#title#\>/g, title);
            $('.J_add_zd_btn').eq(popupIndex).parent().before(html);
        } else {
            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            editObj.find('.add-staff-t').html(title);
            editObj = '';
        }

        $('.J_add_zd').eq(popupIndex).hide();
        $('.J_add_zd_btn').eq(popupIndex).parent().show();

        $('.J_popup').hide();
        $('#J_mask').hide();

        return false;
    });
    // 添加日期字段
    $('.J_add_date_form').click(function () {
        if (editObj === '') {
            var html = $('#J_tpl_date').html();

            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            html = html.replace(/\<#title#\>/g, title);
            $('.J_add_zd_btn').eq(popupIndex).parent().before(html);
        } else {
            var title = $(this).parent().parent().find('.J_add_txt_form_title').val();

            editObj.find('.add-staff-t').html(title);
            editObj = '';
        }

        $('.J_add_zd').eq(popupIndex).hide();
        $('.J_add_zd_btn').eq(popupIndex).parent().show();

        $('.J_popup').hide();
        $('#J_mask').hide();

        return false;
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
