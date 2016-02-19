(function(){
    //顶部导航切换
    $(".J_nav_c").click(function(){
        var text = $(this).text();
        var index = $(".J_nav_c").index(this);

        $(".J_nav_c").removeClass("fs_navigation_item_click");
        $(this).addClass("fs_navigation_item_click");

        $("#J_menu_title").html(text).attr("title", text);

        $("#fs_navigationtree_treerender").find("ul").hide().eq(index).show();
    });

    var width = $(window).width();
    var height = $(window).height();

    $("#fs_west").css({
        height : height - 107
    });
    $("#fs_navigationtree_treerender").css({
        height : height - 154
    });
    $("#J_fr_core_body").css({
        height : height - 150
    });
    $(".J_panel_body").css({
        height : height - 170
    });
    $("#fs_centertab").css({
        width : width - 261,
        height : height - 107
    });
    $("#J_panel_body_index").css({
        width : width - 281,
        height : height - 170
    });
    $("#fs_navigation_wrapper").css({
        width : $("#fs_navigation_wrapper").find(".J_nav_c").length * 70
    });

    $(window).bind("resize", function(){
        width = $(window).width();
        height = $(window).height();

        $("#fs_west").css({
            height : height - 107
        });
        $("#fs_navigationtree_treerender").css({
            height : height - 154
        });
        $("#J_fr_core_body").css({
            height : height - 150
        });
        $(".J_panel_body").css({
            width : width - 281,
            height : height - 170
        });
        $("#fs_centertab").css({
            width : width - 261,
            height : height - 107
        });
        $("#J_panel_body_index").css({
            width : width - 281,
            height : height - 170
        });

        if(tab_num*130+72 > width - 261){
            $(".fr-core-tab-composite").show();
            if(tab_num*130+72 > width - 261){
                del_num = Math.floor((width - 432)/130);

                for(var i = del_num + 1; i < $(".fr-core-tab-composite").length; i++){
                    $(".fr-core-tab-composite").eq(i).hide();
                }

                $("#J_close_all").show().css({
                    left : (del_num+1)*130+75
                });
            }else{
                $("#J_close_all").show().css({
                    left : tab_num*130+75
                });
            }
        }
    });

    //多标签
    var tab_html = '<div class="fr-core-tab-composite" id="{id}" style="left:{left}px"><div data-sel="1" class="fr-core-tab-control fr-core-tab-control-select J_tab_cont"><div class="fr-core-tab-control-text" title="{title}">{title}</div><div class="fr-core-tab-control-icon-wrapper J_tab_cont_close"><div class="fr-core-tab-control-icon"></div></div></div></div>';
    var tab_body_html = '<div class="fr-core-panel"><div class="fr-core-panel-body fr-core-panel-body-noheader fr-core-panel-body-noborder J_panel_body" style="position: absolute;top:0px;left:0px;width:{width}px; height: {height}px;"><iframe frameborder="0" src="{href}" style="height:100%;width: 100%;"></iframe></div></div>';

    $("#J_index_tab").click(function(){
        $("#J_index_tab_cont").show();
        $(".J_panel_body").hide();
        $(".J_tab_cont").removeClass("fr-core-tab-control-select").attr("data-sel", 0);

        return false;
    });

    $("#fs_navigationtree_topdiv_collapse").click(function(){
        $("#fs_west").hide();
        $("#fs_centertab").css({
            left : 20,
            width : width - 45
        });
        $("#J_panel_body_index").css({
            width : width - 65
        });
        $(".J_panel_body").css({
            width : width - 65
        });
        $("#fs_navigationtree_expand").show();
    });

    $("#fs_navigationtree_expand").click(function(){
        $("#fs_west").show();
        $("#fs_centertab").css({
            left : 245,
            width : width - 261
        });
        $("#J_panel_body_index").css({
            width : width - 281
        });
        $(".J_panel_body").css({
            width : width - 281
        });
        $("#fs_navigationtree_expand").hide();
    });

    $(".fr-tree-node-el").click(function(){
        $(".fr-tree-node-el").removeClass("fr-tree-node-el-accordion-selected-leaf");
        $(this).addClass("fr-tree-node-el-accordion-selected-leaf");
    });

    /**
     * 多标签绑定事件
     * 需要添加标签的链接需要加上class名称J_mul_tab
     * 默认会提取标签的title作为标签显示名称，如果没有title则取标签的text文本
     * 如果为A标签的话直接提取href作为链接，如果为其他标签，请添加href标签提取，否则iframe不能正常显示网页
     */
    var tab_num = 0;
    var del_num = 0;
    $(".J_mul_tab").live("click", function(){
        var index = $(".J_mul_tab").index(this);
        var href = $(this).attr("href");
        var title = $(this).attr("title");
        var tmp_tab_html = tab_html;
        var tmp_tab_body_html = tab_body_html;

        $(".J_tab_cont").removeClass("fr-core-tab-control-select").attr("data-sel", 0);
        $(".J_panel_body").hide();
        $("#J_index_tab_cont").hide();

        if($("#J_tab_com_"+ index).length > 0){
            var tab_cont_index = $(".J_tab_cont").index($("#J_tab_com_"+ index).find(".J_tab_cont"));
            if(del_num > 0 && tab_cont_index > del_num){
                $(".fr-core-tab-composite").eq(tab_cont_index).css({
                    left : del_num*130+72
                }).show().find(".J_tab_cont").addClass("fr-core-tab-control-select");
                $(".J_panel_body").eq(tab_cont_index).show();

                $(".fr-core-tab-composite").eq(del_num-1).after($(".fr-core-tab-composite").eq(tab_cont_index));
                $(".fr-core-panel").eq(del_num).after($(".fr-core-panel").eq(tab_cont_index+1));

                for(var i = del_num + 1; i < $(".fr-core-tab-composite").length; i++){
                    $(".fr-core-tab-composite").eq(i).css({
                        left : i*130+72
                    }).hide();
                }
            }else{
                var tmp_tab_cont_obj = $("#J_tab_com_"+ index).find(".J_tab_cont");
                tmp_tab_cont_obj.addClass("fr-core-tab-control-select");
                $(".J_panel_body").eq($(".J_tab_cont").index(tmp_tab_cont_obj)).show();
            }

            return false;
        }

        if(typeof title == "undefined" || title == ""){
            title = $(this).text();
        }

        if((tab_num+1)*130+72 > width - 270){
            del_num = Math.floor((width - 432)/130);

            tmp_tab_html = tmp_tab_html.replace(/{title}/g, title);
            tmp_tab_html = tmp_tab_html.replace(/{id}/, "J_tab_com_"+ index);
            tmp_tab_html = tmp_tab_html.replace(/{left}/, del_num*130+72);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{href}/, href);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{height}/, height - 170);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{width}/, width - 281);

            $(".fr-core-tab-composite").eq(del_num-1).after(tmp_tab_html);

            $(".fr-core-panel").eq(del_num).after(tmp_tab_body_html);

            $("#J_close_all").show().css({
                left : (del_num+1)*130+75
            });

            for(var i = del_num + 1; i < $(".fr-core-tab-composite").length; i++){
                $(".fr-core-tab-composite").eq(i).css({
                    left : i*130+72
                }).hide();
            }
        }else{
            del_num = 0;

            tmp_tab_html = tmp_tab_html.replace(/{title}/g, title);
            tmp_tab_html = tmp_tab_html.replace(/{id}/, "J_tab_com_"+ index);
            tmp_tab_html = tmp_tab_html.replace(/{left}/, tab_num*130+72);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{href}/, href);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{height}/, height - 170);
            tmp_tab_body_html = tmp_tab_body_html.replace(/{width}/, width - 281);

            $("#J_fr_c_h").append(tmp_tab_html);

            $("#J_fr_core_body").append(tmp_tab_body_html);

            $("#J_close_all").show().css({
                left : (tab_num+1)*130+75
            });
        }

        tab_num++;

        return false;
    });
    //点击切换
    $(".J_tab_cont").live("click", function(){
        var index = $(".J_tab_cont").index(this);

        $(".J_tab_cont").removeClass("fr-core-tab-control-select").attr("data-sel", 0);
        $(this).addClass("fr-core-tab-control-select").attr("data-sel", 1);

        $(".J_panel_body").hide().eq(index).show();

        return false;
    }).live("mouseenter", function(){
        $(this).addClass("fr-core-tab-control-hover");
    }).live("mouseleave", function(){
        $(this).removeClass("fr-core-tab-control-hover");
    });
    //关闭
    $(".J_tab_cont_close").live("click", function(){
        var index = $(".J_tab_cont_close").index(this);

        var is_sel = $(".J_tab_cont").eq(index).attr("data-sel");

        tab_num--;

        if(tab_num == 0){
            $("#J_index_tab_cont").show();
            $(".J_tab_cont").parent().remove();
            $(".J_panel_body").parent().remove();
            $("#J_close_all").hide();
        }else{
            if(del_num > 0){
                $(".fr-core-tab-composite").eq(del_num+1).show();
                if((tab_num+1)*130+72 > width - 261){
                    del_num = Math.floor((width - 432)/130);
                }else{
                    del_num = 0;
                }
            }

            if(is_sel == 1){
                if(index == 0){
                    $(".J_tab_cont").eq(1).addClass("fr-core-tab-control-select").attr("data-sel", 1);
                    $(".J_panel_body").eq(1).show();
                }else if(index == $(".J_tab_cont").length - 1){
                    $(".J_tab_cont").eq(index-1).addClass("fr-core-tab-control-select").attr("data-sel", 1);
                    $(".J_panel_body").eq(index-1).show();
                }else{
                    $(".J_tab_cont").eq(index+1).addClass("fr-core-tab-control-select").attr("data-sel", 1);
                    $(".J_panel_body").eq(index+1).show();
                }
            }

            $(".J_tab_cont").eq(index).parent().remove();
            $(".J_panel_body").eq(index).parent().remove();

            for(var i = index; i < $(".J_tab_cont").length; i++){
                $(".J_tab_cont").eq(i).parent().animate({
                    left : parseInt($(".J_tab_cont").eq(i).parent().css("left")) - 130
                }, 500);
            }

            if(del_num == 0){
                $("#J_close_all").animate({
                    left : parseInt($("#J_close_all").css("left")) - 130
                }, 500);
            }
        }
        
        return false;
    });
    //收藏
    $(".fs_tree_favorite").live("click", function(){
        var index = $(".J_mul_tab").index($(this).parent());
        var favorite_i = get_cookie("favorite_tree");
        var fav_rex = new RegExp("(^|,)"+ index +",", "g");
        if(favorite_i == null){
            favorite_i = "";
        }

        if(fav_rex.test(favorite_i)){
            favorite_i = favorite_i.replace(fav_rex, ",");
            favorite_i = favorite_i.replace(/^,/, "");

            $(this).addClass("fs_tree_favorite_nochoose");
        }else{
            favorite_i += index +",";

            $(this).removeClass("fs_tree_favorite_nochoose");
        }

        set_cookie("favorite_tree", favorite_i, 10);

        create_fav();

        return false;
    });
    $(".fs_navigationtree_topdiv_icon_mask").click(function(){
        var is_show = $(this).attr("data-show");

        if(is_show == 1){
            $(this).attr("data-show", 0).next().attr("class", "fs_navigationtree_topdiv_icon");

            $("#fs_navigationtree_treerender").show();
            $("#J_fav_tree").hide();

            $("#J_menu_title").html($("#J_menu_title").attr("title"));
        }else{
            $(this).attr("data-show", 1).next().attr("class", "fs_navigationtree_topdiv_open_icon");

            $("#fs_navigationtree_treerender").hide();
            $("#J_fav_tree").show().css({
                height : height - 154
            });
            $("#J_menu_title").html("收藏夹");
        }
    }).mouseenter(function(){
        $(this).addClass("fs_navigationtree_topdiv_over");
    }).mouseleave(function(){
        $(this).removeClass("fs_navigationtree_topdiv_over");
    });
    $(".fs_navigationtree_topdiv_icon").click(function(){
        var is_show = $(this).attr("data-show");

        if(is_show == 1){
            $(this).attr("data-show", 0).attr("class", "fs_navigationtree_topdiv_icon");

            $("#fs_navigationtree_treerender").show();
            $("#J_fav_tree").hide();

            $("#J_menu_title").html($("#J_menu_title").attr("title"));
        }else{
            $(this).attr("data-show", 1).attr("class", "fs_navigationtree_topdiv_open_icon");

            $("#fs_navigationtree_treerender").hide();
            $("#J_fav_tree").show().css({
                height : height - 154
            });
            $("#J_menu_title").html("收藏夹");
        }
    }).mouseenter(function(){
        $(".fs_navigationtree_topdiv_icon_mask").addClass("fs_navigationtree_topdiv_over");
    }).mouseleave(function(){
        $(".fs_navigationtree_topdiv_icon_mask").removeClass("fs_navigationtree_topdiv_over");
    });

    function create_fav(){
        var favorite_i = get_cookie("favorite_tree");
        if(favorite_i == null || favorite_i == ""){
            $("#J_fav_tree").html("");
            return false;
        }
        favorite_i = favorite_i.replace(/,$/, "").split(",");

        var html = "";
        for(var i = 0; i < favorite_i.length; i++){
            var tab_obj = $(".J_mul_tab").eq(favorite_i[i]);
            tab_obj.find(".fs_tree_favorite").removeClass("fs_tree_favorite_nochoose")
            var href = tab_obj.attr("href");
            var title = tab_obj.attr("title");
            var cla = i%2 == 0 ? "fs-tree-node-el-even" : "fs-tree-node-el-odd";

            html += '<li class="fr-tree-node"><a href="'+ href +'" class="fr-tree-node-el fr-tree-node-bi fr-tree-node-el-accordion '+ cla +' J_mul_tab_fav" data-index="'+ favorite_i[i] +'" title="'+ title +'"><span class="fr-tree-node-left"></span><span class="fr-tree-elbow fr-tree-leaf-biicon" style="float: left;"></span><div class="fr-tree-node-textwrap"><span class="fs-tree-node-content" unselectable="on" title="'+ title +'">'+ title +'</span></div></a></li>';
        }

        $("#J_fav_tree").html(html);
    }
    create_fav();
    $(".J_mul_tab_fav").live("click", function(){
        var index = $(this).attr("data-index");
        var href = $(this).attr("href");
        var title = $(this).attr("title");
        var tmp_tab_html = tab_html;
        var tmp_tab_body_html = tab_body_html;

        $(".J_tab_cont").removeClass("fr-core-tab-control-select").attr("data-sel", 0);
        $(".J_panel_body").hide();
        $("#J_index_tab_cont").hide();

        if($("#J_tab_com_"+ index).length > 0){
            var tmp_tab_cont_obj = $("#J_tab_com_"+ index).find(".J_tab_cont");
            tmp_tab_cont_obj.addClass("fr-core-tab-control-select").attr("data-sel", 1);
            $(".J_panel_body").eq($(".J_tab_cont").index(tmp_tab_cont_obj)).show();

            return false;
        }

        if(typeof title == "undefined" || title == ""){
            title = $(this).text();
        }

        tmp_tab_html = tmp_tab_html.replace(/{title}/g, title);
        tmp_tab_html = tmp_tab_html.replace(/{id}/, "J_tab_com_"+ index);
        tmp_tab_html = tmp_tab_html.replace(/{left}/, tab_num*130+72);
        tmp_tab_body_html = tmp_tab_body_html.replace(/{href}/, href);
        tmp_tab_body_html = tmp_tab_body_html.replace(/{height}/, height - 150);
        tmp_tab_body_html = tmp_tab_body_html.replace(/{width}/, width - 281);

        $("#J_fr_core_body").append(tmp_tab_body_html);

        $("#J_fr_c_h").append(tmp_tab_html);

        $("#J_close_all").show().css({
            left : (tab_num+1)*130+75
        });

        tab_num++;

        return false;
    });

    $("#J_close_all").click(function(){
        var c_position = $(this).offset();
        $("body").append('<div class="fr-core-tab-popup" id="J_close_tab_all" style="width: 110px; height: 30px; display: block; top: '+ (c_position.top+28) +'px; left: '+ (c_position.left-85) +'px; z-index: 8005;"><div class="fr-core-tab-control-menu-item" title="关闭全部" style="position: absolute; cursor: default; top: 0px; left: 0px; width: 110px; height: 30px; line-height: 30px; white-space: nowrap;cursor:pointer">关闭全部</div></div>');
    }).mouseenter(function(){
        $(this).addClass("fr-core-tab-control-more-hover");
    }).mouseleave(function(){
        $(this).removeClass("fr-core-tab-control-more-hover");
    });

    $("#J_close_tab_all").live("click", function(){
        $("#J_index_tab_cont").show();
        $(".J_tab_cont").parent().remove();
        $(".J_panel_body").parent().remove();
        $("#J_close_all").hide();

        tab_num = 0;

        $(this).remove();
    }).live("mouseenter", function(){
        $(this).find(".fr-core-tab-control-menu-item").addClass("fr-core-tab-control-menu-item-hover");
    }).live("mouseleave", function(){
        $(this).remove();
    });

    function set_cookie(name, value, times){
        var times = times || 1;
        var ntime  = new Date();
        var domain = location.hostname || '';
        ntime.setTime(ntime.getTime() + times*24*60*60*1000);
        document.cookie = name + "="+ value + ";expires=" + ntime.toGMTString() +";path=/;domain="+ domain;
    };

    function get_cookie(name){
        var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null){
            return arr[2];
        }
        return null;
    };

}());